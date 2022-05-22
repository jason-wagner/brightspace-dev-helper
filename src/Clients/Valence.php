<?php

namespace BrightspaceDevHelper\Valence\Client;

use BrightspaceDevHelper\Valence\SDK\D2LUserContext;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\ClientException;
use GuzzleHttp\Exception\ServerException;

use BrightspaceDevHelper\Valence\SDK\D2LAppContextFactory;
use BrightspaceDevHelper\Valence\SDK\D2LHostSpec;

use BrightspaceDevHelper\DataHub\Model\OrganizationalUnit;
use BrightspaceDevHelper\DataHub\Model\User;

use BrightspaceDevHelper\Valence\Attributes\GRPENROLL;
use BrightspaceDevHelper\Valence\Attributes\SECTENROLL;

use BrightspaceDevHelper\Valence\Block\CourseOffering;
use BrightspaceDevHelper\Valence\Block\EnrollmentData;
use BrightspaceDevHelper\Valence\Block\Forum;
use BrightspaceDevHelper\Valence\Block\GroupCategoryData;
use BrightspaceDevHelper\Valence\Block\GroupData;
use BrightspaceDevHelper\Valence\Block\LegalPreferredNames;
use BrightspaceDevHelper\Valence\Block\Organization;
use BrightspaceDevHelper\Valence\Block\OrgUnitType;
use BrightspaceDevHelper\Valence\Block\Post;
use BrightspaceDevHelper\Valence\Block\ProductVersions;
use BrightspaceDevHelper\Valence\Block\Role;
use BrightspaceDevHelper\Valence\Block\SectionData;
use BrightspaceDevHelper\Valence\Block\SectionPropertyData;
use BrightspaceDevHelper\Valence\Block\Topic;
use BrightspaceDevHelper\Valence\Block\UserData;
use BrightspaceDevHelper\Valence\Block\WhoAmIUser;

use BrightspaceDevHelper\Valence\BlockArray\BrightspaceDataSetReportInfoArray;
use BrightspaceDevHelper\Valence\BlockArray\ForumArray;
use BrightspaceDevHelper\Valence\BlockArray\GroupCategoryDataArray;
use BrightspaceDevHelper\Valence\BlockArray\GroupDataArray;
use BrightspaceDevHelper\Valence\BlockArray\OrgUnitTypeArray;
use BrightspaceDevHelper\Valence\BlockArray\OrgUnitUserArray;
use BrightspaceDevHelper\Valence\BlockArray\PostArray;
use BrightspaceDevHelper\Valence\BlockArray\ProductVersionArray;
use BrightspaceDevHelper\Valence\BlockArray\RoleArray;
use BrightspaceDevHelper\Valence\BlockArray\SectionDataArray;
use BrightspaceDevHelper\Valence\BlockArray\TopicArray;

class Valence
{
	private Client $httpclient;
	private D2LUserContext $handler;

	private bool $returnObjectOnCreate = false;
	private int $logMode = 0;
	private $logFileHandler = null;
	private bool $exitOnError = true;

	public const VERSION_LP = '1.35';
	public const VERSION_LE = '1.61';

	protected ?int $responseCode = null;
	protected ?array $responseBody = null;
	protected ?string $responseError = null;

	public string $newUserClass = ValenceUser::class;
	public string $newCourseClass = ValenceCourse::class;

	public array $roleIds = [];
	public array $orgtypeIds = [];

	public ?int $rootOrgId = null;
	public ?string $timezone = null;

	private array $datahubFirst = [];

	public function __construct()
	{
		$authContextFactory = new D2LAppContextFactory();
		$authContext = $authContextFactory->createSecurityContext($_ENV['D2L_VALENCE_APP_ID'], $_ENV['D2L_VALENCE_APP_KEY']);
		$hostSpec = new D2LHostSpec($_ENV['D2L_VALENCE_HOST'], $_ENV['D2L_VALENCE_PORT'], $_ENV['D2L_VALENCE_SCHEME']);
		$this->handler = $authContext->createUserContextFromHostSpec($hostSpec, $_ENV['D2L_VALENCE_USER_ID'], $_ENV['D2L_VALENCE_USER_KEY']);
		$this->httpclient = new Client(['base_uri' => "{$_ENV['D2L_VALENCE_SCHEME']}://{$_ENV['D2L_VALENCE_HOST']}'/"]);

		$org = $this->getOrganization();

		if ($this->isValidResponseCode()) {
			$this->rootOrgId = $org->Identifier;
			$this->timezone = $org->TimeZone;
		}
	}

	public function apirequest(string $route, string $method = 'GET', ?array $data = null): ?array
	{
		$uri = $this->handler->createAuthenticatedUri(str_replace(' ', '%20', $route), $method);

		try {
			$response = $this->httpclient->request($method, $uri, ['json' => $data]);

			$this->responseCode = $response->getStatusCode();
			$this->responseBody = json_decode($response->getBody(), 1);
			$this->responseError = null;

			if ($this->logMode == 2 || ($this->logMode == 1 && in_array($method, ['POST', 'PUT', 'DELETE'])))
				$this->logrequest($route, $method, $data);

			return $this->responseBody;
		} catch (ClientException|ServerException $exception) {
			$response = $exception->getResponse();

			$this->responseCode = $response->getStatusCode();
			$this->responseBody = null;
			$this->responseError = $response->getBody()->getContents();

			if ($this->logMode == 2 || ($this->logMode == 1 && in_array($method, ['POST', 'PUT', 'DELETE'])))
				$this->logrequest($route, $method, $data);

			if ($this->exitOnError) {
				fwrite(STDERR, "Error: $this->responseCode $this->responseError (exiting...)\n");
				exit(1);
			}

			return null;
		}
	}

	public function apirequestfile(string $route, string $filepath)
	{
		$uri = $this->handler->createAuthenticatedUri(str_replace(' ', '%20', $route), 'GET');

		try {
			$filehandler = fopen($filepath, 'w');
			$response = $this->httpclient->request('GET', $uri, ['sink' => $filehandler]);

			$this->responseCode = $response->getStatusCode();

			if ($this->logMode == 2)
				$this->logrequest($route, 'GET');

			return true;
		} catch (ClientException|ServerException $exception) {
			$response = $exception->getResponse();

			$this->responseCode = $response->getStatusCode();
			$this->responseError = $response->getBody()->getContents();

			if ($this->logMode == 2)
				$this->logrequest($route, 'GET');

			if ($this->exitOnError) {
				fwrite(STDERR, "Error: $this->responseCode $this->responseError (exiting...)\n");
				exit(1);
			}

			return false;
		}
	}

	public function apisendfile(string $route, string $method, string $filepath, string $field, string $name)
	{
		$uri = $this->handler->createAuthenticatedUri(str_replace(' ', '%20', $route), $method);

		try {
			$formdata = [
				['name' => $field, 'filename' => $name, 'contents' => fopen($filepath, 'r')]
			];

			$response = $this->httpclient->request($method, $uri, ['multipart' => $formdata]);

			$this->responseCode = $response->getStatusCode();

			if ($this->logMode == 2)
				$this->logrequest($route, $method, ['placeholder']);

			return true;
		} catch (ClientException|ServerException $exception) {
			$response = $exception->getResponse();

			$this->responseCode = $response->getStatusCode();
			$this->responseError = $response->getBody()->getContents();

			if ($this->logMode == 2)
				$this->logrequest($route, $method, ['placeholder']);

			if ($this->exitOnError) {
				fwrite(STDERR, "Error: $this->responseCode $this->responseError (exiting...)\n");
				exit(1);
			}

			return false;
		}
	}

	private function logrequest(string $route, string $method, ?array $data = null): void
	{
		$logEntry = date("Y-m-d H:i:s") . " $method $route " . json_encode($data ?? []) . " $this->responseCode\n";
		fwrite($this->logFileHandler, $logEntry);
	}

	public function setDatahubSearch(string $report, int $mode)
	{
		$this->datahubFirst[$report] = $mode;
	}

	private function getDatahubSearch(string $report)
	{
		return $this->datahubFirst[$report] ?? 0;
	}

	public function setLogging(int $logMode, ?string $logFile = null): void
	{
		$this->logMode = $logMode;

		if ($this->logFileHandler)
			fclose($this->logFileHandler);

		$this->logFileHandler = fopen($logFile ?? 'valence.log', 'a');
	}

	public function setReturnObjectOnCreate(bool $returnobject): void
	{
		$this->returnObjectOnCreate = $returnobject;
	}

	public function setExitOnError(bool $exitonerror): void
	{
		$this->exitOnError = $exitonerror;
	}

	public function responseCode(): ?int
	{
		return $this->responseCode;
	}

	public function responseBody(): ?array
	{
		return $this->responseBody;
	}

	public function responseError(): ?string
	{
		return $this->responseError;
	}

	public function isValidResponseCode(): bool
	{
		return floor($this->responseCode() / 100) == 2;
	}

	public function setUserClass($userclass): void
	{
		$this->newUserClass = $userclass;
	}

	public function setCourseClass($courseclass): void
	{
		$this->newCourseClass = $courseclass;
	}

	public function setInternalIds(): void
	{
		$roles = $this->getRoles();

		while ($role = $roles->next())
			$this->roleIds[$role->DisplayName] = $role->Identifier;

		$orgtypes = $this->getOrgUnitTypes();

		while ($orgtype = $orgtypes->next())
			$this->orgtypeIds[$orgtype->Code] = $orgtype->Id;
	}

	public function whoami(): ?WhoAmIUser
	{
		$response = $this->apirequest("/d2l/api/lp/" . self::VERSION_LP . "/users/whoami");
		return $this->isValidResponseCode() ? new WhoAmIUser($response) : null;
	}

	public function getOrganization(): ?Organization
	{
		$response = $this->apirequest("/d2l/api/lp/" . self::VERSION_LP . "/organization/info");
		return $this->isValidResponseCode() ? new Organization($response) : null;
	}

	public function version(string $productCode): ?ProductVersions
	{
		$response = $this->apirequest("/d2l/api/$productCode/versions/");

		return $this->isValidResponseCode() ? new ProductVersions($response) : null;
	}

	public function versions(): ProductVersionArray
	{
		$response = $this->apirequest("/d2l/api/versions/");
		return new ProductVersionArray($response);
	}

	public function getRole($roleId): ?Role
	{
		$response = $this->apirequest("/d2l/api/lp/" . self::VERSION_LP . "/roles/$roleId");
		return $this->isValidResponseCode() ? new Role($response) : null;
	}

	public function getRoles(): RoleArray
	{
		$response = $this->apirequest("/d2l/api/lp/" . self::VERSION_LP . "/roles/");
		return new RoleArray($response);
	}

	public function getOrgUnitType($orgUnitTypeId): ?OrgUnitType
	{
		$response = $this->apirequest("/d2l/api/lp/" . self::VERSION_LP . "/outypes/$orgUnitTypeId");
		return $this->isValidResponseCode() ? new OrgUnitType($response) : null;
	}

	public function getOrgUnitTypes(): OrgUnitTypeArray
	{
		$response = $this->apirequest("/d2l/api/lp/" . self::VERSION_LP . "/outypes/");
		return new OrgUnitTypeArray($response);
	}

	public function getBrightSpaceDataSets(): BrightspaceDataSetReportInfoArray
	{
		$response = $this->apirequest("/d2l/api/lp/" . self::VERSION_LP . "/dataExport/bds");
		return new BrightspaceDataSetReportInfoArray($response);
	}

	public function user(int $userid): ValenceUser
	{
		return new $this->newUserClass($this, $userid);
	}

	public function course(int $orgid): ValenceCourse
	{
		return new $this->newCourseClass($this, $orgid);
	}

	public function getUserIdFromUsername(string $username): ?int
	{
		if ($this->getDatahubSearch('Users') > 0) {
			$user = User::whereUserName($username);

			if ($user)
				return $user->UserId;
		}

		try {
			$response = $this->apirequest("/d2l/api/lp/" . self::VERSION_LP . "/users/?userName=$username");
			return $response['UserId'] ?? null;
		} catch (Exception $e) {
			return null;
		}
	}

	public function getUserIdFromOrgDefinedId(string $orgDefinedId): ?int
	{
		if ($this->getDatahubSearch('Users') > 0) {
			$user = User::whereOrgDefinedId($orgDefinedId);

			if ($user)
				return $user->UserId;
		}

		try {
			$response = $this->apirequest("/d2l/api/lp/" . self::VERSION_LP . "/users/?orgDefinedId=$orgDefinedId");
			return $response['UserId'] ?? null;
		} catch (Exception $e) {
			return null;
		}
	}

	public function getOrgUnitIdFromCode(string $orgUnitCode, int $orgUnitType): ?int
	{
		if ($this->getDatahubSearch('OrganizationalUnits') > 0) {
			$orgunit = OrganizationalUnit::whereCodeAndType($orgUnitCode, $orgUnitType);

			if ($orgunit)
				return $orgunit->OrgUnitId;
		}

		try {
			$response = $this->apirequest("/d2l/api/lp/" . self::VERSION_LP . "/orgstructure/?orgUnitType=$orgUnitType&exactOrgUnitCode=$orgUnitCode");
			return $response['Items'][0]['Identifier'] ?? null;
		} catch (Exception $e) {
			return null;
		}
	}

	public function getOrgUnitIdFromOfferingCode(string $offeringCode): ?int
	{
		if (!count($this->orgtypeIds))
			$this->setInternalIds();

		return $this->getOrgUnitIdFromCode($offeringCode, $this->orgtypeIds['Course Offering']);
	}

	public function getOrgUnitIdFromSemesterCode(string $semesterCode): ?int
	{
		if (!count($this->orgtypeIds))
			$this->setInternalIds();

		return $this->getOrgUnitIdFromCode($semesterCode, $this->orgtypeIds['Semester']);
	}

	public function getOrgUnitIdFromTemplateCode(string $templateCode): ?int
	{
		if (!count($this->orgtypeIds))
			$this->setInternalIds();

		return $this->getOrgUnitIdFromCode($templateCode, $this->orgtypeIds['Course Template']);
	}

	public function getOrgUnitIdFromDepartmentCode(string $departmentCode): ?int
	{
		if (!count($this->orgtypeIds))
			$this->setInternalIds();

		return $this->getOrgUnitIdFromCode($departmentCode, $this->orgtypeIds['Department']);
	}

	public function enrollUser(int $OrgUnitId, int $UserId, int $RoleId): ?EnrollmentData
	{
		$data = compact('OrgUnitId', 'UserId', 'RoleId');
		$response = $this->apirequest("/d2l/api/lp/" . self::VERSION_LP . "/enrollments/", "POST", $data);
		return $response ? new EnrollmentData($response) : null;
	}

	public function unenrollUser(int $userId, int $orgUnitId): void
	{
		$this->apirequest("/d2l/api/lp/" . self::VERSION_LP . "/enrollments/users/$userId/orgUnits/$orgUnitId", "DELETE");
	}

	public function getEnrollments(int $orgUnitId): ?OrgUnitUserArray
	{
		$response = $this->apirequest("/d2l/api/lp/" . self::VERSION_LP . "/enrollments/orgUnits/$orgUnitId/users/?isActive=1", "GET");
		return $response ? new OrgUnitUserArray($response, $orgUnitId) : null;
	}

	public function getEnrollment(int $orgUnitId, int $userId): ?EnrollmentData
	{
		$response = $this->apirequest("/d2l/api/lp/" . self::VERSION_LP . "/enrollments/orgUnits/$orgUnitId/users/$userId");
		return $response ? new EnrollmentData($response) : null;
	}

	public function enrollStudent(int $OrgUnitId, int $UserId): ?EnrollmentData
	{
		if (!count($this->roleIds))
			$this->setInternalIds();

		return $this->enrollUser($OrgUnitId, $UserId, $this->roleIds['Student']);
	}

	public function enrollInstructor(int $OrgUnitId, int $UserId): ?EnrollmentData
	{
		if (!count($this->roleIds))
			$this->setInternalIds();

		return $this->enrollUser($OrgUnitId, $UserId, $this->roleIds['Instructor']);
	}

	public function getCourseOffering(int $orgUnitId): ?CourseOffering
	{
		$response = $this->apirequest("/d2l/api/lp/" . self::VERSION_LP . "/courses/$orgUnitId");
		return $response ? new CourseOffering($response) : null;
	}

	public function createCourseOffering(string $Name, string $Code, string $Path, int $CourseTemplateId, int $SemesterId, ?string $StartDate, ?string $EndDate, ?int $LocaleId, bool $ForceLocale, bool $ShowAddressBook, ?string $DescriptionText, bool $CanSelfRegister)
	{
		$data = compact('Name', 'Code', 'Path', 'CourseTemplateId', 'SemesterId', 'StartDate', 'EndDate', 'LocaleId', 'ForceLocale', 'ShowAddressBook', 'CanSelfRegister');
		$data['Description'] = ['Type' => 'Text', 'Content' => $DescriptionText];
		$response = $this->apirequest("/d2l/api/lp/" . self::VERSION_LP . "/courses/", "POST", $data);
		return $this->returnObjectOnCreate ? $this->course($response['Identifier']) : new CourseOffering($response);
	}

	public function updateCourseOffering(int $orgUnitId, string $Name, string $Code, ?string $StartDate, ?string $EndDate, bool $IsActive, string $DescriptionText): ?CourseOffering
	{
		$data = compact('Name', 'Code', 'StartDate', 'EndDate', 'IsActive');
		$data['Description'] = ['Type' => 'Text', 'Content' => $DescriptionText];
		$response = $this->apirequest("/d2l/api/lp/" . self::VERSION_LP . "/courses/$orgUnitId", "PUT", $data);
		return $response ? new CourseOffering($response) : null;
	}

	public function deleteCourseOffering(int $orgUnitId): void
	{
		$this->apirequest("/d2l/api/lp/" . self::VERSION_LP . "/courses/$orgUnitId", "DELETE");
	}

	public function getCourseImage(int $orgUnitId, string $filepath): bool
	{
		return $this->apirequestfile("/d2l/api/lp/" . self::VERSION_LP . "/courses/$orgUnitId/image", $filepath);
	}

	public function uploadCourseImage(int $orgUnitId, string $filepath, string $name): bool
	{
		return $this->apisendfile("/d2l/api/lp/" . self::VERSION_LP . "/courses/$orgUnitId/image", "PUT", $filepath, "Image", $name);
	}

	public function getCourseSections(int $orgUnitId): SectionDataArray
	{
		$response = $this->apirequest("/d2l/api/lp/" . self::VERSION_LP . "/$orgUnitId/sections/");
		return new SectionDataArray($response);
	}

	public function getCourseSection(int $orgUnitId, int $sectionId): ?SectionData
	{
		$response = $this->apirequest("/d2l/api/lp/" . self::VERSION_LP . "/$orgUnitId/sections/$sectionId");
		return $response ? new SectionData($response) : null;
	}

	public function createCourseSection(int $orgUnitId, string $Name, string $Code, string $DescriptionText): ?SectionData
	{
		$data = compact('Name', 'Code');
		$data['Description'] = ['Type' => 'Text', 'Content' => $DescriptionText];
		$response = $this->apirequest("/d2l/api/lp/" . self::VERSION_LP . "/$orgUnitId)/sections/", "POST", $data);
		return $response ? new SectionData($response) : null;
	}

	public function updateCourseSection(int $orgUnitId, int $sectionId, string $Name, string $Code, string $DescriptionText): ?SectionData
	{
		$data = compact('Name', 'Code');
		$data['Description'] = ['Type' => 'Text', 'Content' => $DescriptionText];
		$response = $this->apirequest("/d2l/api/lp/" . self::VERSION_LP . "/$orgUnitId/sections/$sectionId", "PUT", $data);
		return $response ? new SectionData($response) : null;
	}

	public function initializeCourseSections(int $orgUnitId, SECTENROLL $EnrollmentStyle, int $EnrollmentQuantity, bool $AuthEnroll, bool $RandomizeEnrollments): ?SectionData
	{
		$data = compact('EnrollmentQuantity', 'AuthEnroll', 'RandomizeEnrollments');
		$data['EnrollmentStyle'] = $EnrollmentStyle->value;
		$response = $this->apirequest("/d2l/api/lp/" . self::VERSION_LP . "/$orgUnitId/sections/", "PUT", $data);
		return $response ? new SectionData($response) : null;
	}

	public function deleteCourseSection(int $orgUnitId, int $sectionId): void
	{
		$this->apirequest("/d2l/api/lp/" . self::VERSION_LP . "/$orgUnitId/sections/$sectionId", "DELETE");
	}

	public function enrollUserInCourseSection(int $orgUnitId, int $sectionId, int $UserId): array
	{
		$data = compact('UserId');
		return $this->apirequest("/d2l/api/lp/" . self::VERSION_LP . "/$orgUnitId/sections/$sectionId/enrollments/", "POST", $data);
	}

	public function getCourseSectionSettings(int $orgUnitId): ?SectionPropertyData
	{
		$response = $this->apirequest("/d2l/api/lp/" . self::VERSION_LP . "/$orgUnitId/sections/settings");
		return $response ? new SectionPropertyData($response) : null;
	}

	public function updateCourseSectionSettings(int $orgUnitId, SECTENROLL $EnrollmentStyle, int $EnrollmentQuantity, int $AuthEnroll, int $RandomizeEnrollments): ?SectionPropertyData
	{
		$data = compact('EnrollmentQuantity', 'AuthEnroll', 'RandomizeEnrollments');
		$data['EnrollmentStyle'] = $EnrollmentStyle->value;
		$response = $this->apirequest("/d2l/api/lp/" . self::VERSION_LP . "/$orgUnitId/sections/settings", "PUT", $data);
		return $response ? new SectionPropertyData($response) : null;
	}

	public function getCourseGroupCategories(int $orgUnitId): GroupCategoryDataArray
	{
		$response = $this->apirequest("/d2l/api/lp/" . self::VERSION_LP . "/$orgUnitId/groupcategories/");
		return new GroupCategoryDataArray($response);
	}

	public function getCourseGroupCategory(int $orgUnitId, int $groupCategoryId): ?GroupCategoryData
	{
		$response = $this->apirequest("/d2l/api/lp/" . self::VERSION_LP . "/$orgUnitId/groupcategories/$groupCategoryId");
		return $response ? new GroupCategoryData($response) : null;
	}

	public function createCourseGroupCategory(int $orgUnitId, string $Name, string $DescriptionText, GRPENROLL $EnrollmentStyle, ?int $EnrollmentQuantity, bool $AutoEnroll, bool $RandomizeEnrollments, ?int $NumberOfGroups, ?int $MaxUsersPerGroup, bool $AllocateAfterExpiry, ?string $SelfEnrollmentExpiryDate, ?string $GroupPrefix, ?int $RestrictedByOrgUnitId): ?GroupCategoryData
	{
		$data = compact('Name', 'EnrollmentQuantity', 'AutoEnroll', 'RandomizeEnrollments', 'NumberOfGroups', 'MaxUsersPerGroup', 'AllocateAfterExpiry', 'SelfEnrollmentExpiryDate', 'GroupPrefix', 'RestrictedByOrgUnitId');
		$data['EnrollmentStyle'] = $EnrollmentStyle->value;
		$data['Description'] = ['Type' => 'Text', 'Content' => $DescriptionText];
		$response = $this->apirequest("/d2l/api/lp/" . self::VERSION_LP . "/$orgUnitId/groupcategories/", "POST", $data);
		return $response ? new GroupCategoryData($response) : null;
	}

	public function deleteCourseGroupCategory(int $orgUnitId, int $groupCategoryId): void
	{
		$this->apirequest("/d2l/api/lp/" . self::VERSION_LP . "/$orgUnitId/groupcategories/$groupCategoryId", "DELETE");
	}

	public function updateCourseGroupCategory(int $orgUnitId, int $groupCategoryId, string $Name, string $DescriptionText, GRPENROLL $EnrollmentStyle, ?int $EnrollmentQuantity, bool $AutoEnroll, bool $RandomizeEnrollments, ?int $NumberOfGroups, ?int $MaxUsersPerGroup, bool $AllocateAfterExpiry, ?string $SelfEnrollmentExpiryDate, ?string $GroupPrefix, ?int $RestrictedByOrgUnitId): ?GroupCategoryData
	{
		$data = compact('Name', 'EnrollmentQuantity', 'AutoEnroll', 'RandomizeEnrollments', 'NumberOfGroups', 'MaxUsersPerGroup', 'AllocateAfterExpiry', 'SelfEnrollmentExpiryDate', 'GroupPrefix', 'RestrictedByOrgUnitId');
		$data['EnrollmentStyle'] = $EnrollmentStyle->value;
		$data['Description'] = ['Type' => 'Text', 'Content' => $DescriptionText];
		$response = $this->apirequest("/d2l/api/lp/" . self::VERSION_LP . "/$orgUnitId/groupcategories/$groupCategoryId", "PUT", $data);
		return $response ? new GroupCategoryData($response) : null;
	}

	public function getCourseGroups(int $orgUnitId, int $groupCategoryId): GroupDataArray
	{
		$response = $this->apirequest("/d2l/api/lp/" . self::VERSION_LP . "/$orgUnitId/groupcategories/$groupCategoryId/groups/");
		return new GroupDataArray($response);
	}

	public function getCourseGroup(int $orgUnitId, int $groupCategoryId, int $groupId): ?GroupData
	{
		$response = $this->apirequest("/d2l/api/lp/" . self::VERSION_LP . "/$orgUnitId/groupcategories/$groupCategoryId/groups/$groupId");
		return $response ? new GroupData($response) : null;
	}

	public function createCourseGroup(int $orgUnitId, int $groupCategoryId, string $Name, string $Code, string $DescriptionText): ?GroupData
	{
		$data = compact('Name', 'Code');
		$data['Description'] = ['Type' => 'Text', 'Content' => $DescriptionText];
		$response = $this->apirequest("/d2l/api/lp/" . self::VERSION_LP . "/$orgUnitId/groupcategories/$groupCategoryId/groups/", "POST", $data);
		return $response ? new GroupData($response) : null;
	}

	public function updateCourseGroup(int $orgUnitId, int $groupCategoryId, int $groupId, string $Name, string $Code, string $DescriptionText): ?GroupData
	{
		$data = compact('Name', 'Code');
		$data['Description'] = ['Type' => 'Text', 'Content' => $DescriptionText];
		$response = $this->apirequest("/d2l/api/lp/" . self::VERSION_LP . "/$orgUnitId/groupcategories/$groupCategoryId/groups/$groupId", "PUT", $data);
		return $response ? new GroupData($response) : null;
	}

	public function enrollUserInGroup(int $orgUnitId, int $groupCategoryId, int $groupId, int $UserId): array
	{
		$data = compact('UserId');
		return $this->apirequest("/d2l/api/lp/" . self::VERSION_LP . "/$orgUnitId/groupcategories/$groupCategoryId/groups/$groupId/enrollments/", "POST", $data);
	}

	public function unenrollUserFromGroup(int $orgUnitId, int $groupCategoryId, int $groupId, int $userId): void
	{
		$this->apirequest("/d2l/api/lp/" . self::VERSION_LP . "/$orgUnitId/groupcategories/$groupCategoryId/groups/$groupId/enrollments/$userId", "DELETE");
	}

	public function deleteCourseGroup(int $orgUnitId, int $groupCategoryId, int $groupId): void
	{
		$this->apirequest("/d2l/api/lp/" . self::VERSION_LP . "/$orgUnitId/groupcategories/$groupCategoryId/groups/$groupId", "DELETE");
	}

	public function getUser(int $userId): ?UserData
	{
		$response = $this->apirequest("/d2l/api/lp/" . self::VERSION_LP . "/users/$userId");
		return $response ? new UserData($response) : null;
	}

	public function getUserNames(int $userId): ?LegalPreferredNames
	{
		$response = $this->apirequest("/d2l/api/lp/" . self::VERSION_LP . "/users/$userId/names");
		return $this->isValidResponseCode() ? new LegalPreferredNames($response) : null;
	}

	public function updateUserNames(int $userId, string $LegalFirstName, string $LegalLastName, ?string $PreferredFirstName, ?string $PreferredLastName): ?LegalPreferredNames
	{
		$data = compact('LegalFirstName', 'LegalLastName', 'PreferredFirstName', 'PreferredLastName');
		$response = $this->apirequest("/d2l/api/lp/" . self::VERSION_LP . "/users/$userId/names", "PUT", $data);
		return $this->isValidResponseCode() ? new LegalPreferredNames($response) : null;
	}

	public function getUserProfile(int $userId): array
	{
		return $this->apirequest("/d2l/api/lp/" . self::VERSION_LP . "/profile/user/$userId");
	}

	public function getUserPicture(int $userId, string $filepath): bool
	{
		return $this->apirequestfile("/d2l/api/lp/" . self::VERSION_LP . "/profile/user/$userId/image", $filepath);
	}

	public function uploadUserPicture(int $userId, string $filepath): bool
	{
		return $this->apisendfile("/d2l/api/lp/" . self::VERSION_LP . "/profile/user/$userId/image", "POST", $filepath, 'profileImage', 'profileImage');
	}

	public function deleteUserPicture(int $userId): void
	{
		$this->apirequest("/d2l/api/lp/" . self::VERSION_LP . "/profile/user/$userId/image", "DELETE");
	}

	public function pinCourse(int $orgUnitId, int $userId): void
	{
		$this->apirequest("/d2l/api/lp/" . self::VERSION_LP . "/enrollments/orgUnits/$orgUnitId/users/$userId/pin", "POST");
	}

	public function unpinCourse(int $orgUnitId, int $userId): void
	{
		$this->apirequest("/d2l/api/lp" . self::VERSION_LP . "/enrollments/orgUnits/$orgUnitId/users/$userId/pin", "DELETE");
	}

	public function getDiscussionForums(int $orgUnitId): ForumArray
	{
		$response = $this->apirequest("/d2l/api/le/" . self::VERSION_LE . "/$orgUnitId/discussions/forums/", "GET");
		return new ForumArray($response);
	}

	public function getDiscussionForum(int $orgUnitId, int $forumId): ?Forum
	{
		$response = $this->apirequest("/d2l/api/le/" . self::VERSION_LE . "/$orgUnitId/discussions/forums/$forumId", "GET");
		return $this->isValidResponseCode() ? new Forum($response) : null;
	}

	public function getDiscussionTopics(int $orgUnitId, int $forumId): TopicArray
	{
		$response = $this->apirequest("/d2l/api/le/" . self::VERSION_LE . "/$orgUnitId/discussions/forums/$forumId/topics/", "GET");
		return new TopicArray($response);
	}

	public function getDiscussionTopic(int $orgUnitId, int $forumId, int $topicId): ?Topic
	{
		$response = $this->apirequest("/d2l/api/le/" . self::VERSION_LE . "/$orgUnitId/discussions/forums/$forumId/topics/$topicId", "GET");
		return $this->isValidResponseCode() ? new Topic($response) : null;
	}

	public function getDiscussionPosts(int $orgUnitId, int $forumId, int $topicId): PostArray
	{
		$response = $this->apirequest("/d2l/api/le/" . self::VERSION_LE . "/$orgUnitId/discussions/forums/$forumId/topics/$topicId/posts/", "GET");
		return new PostArray($response);
	}

	public function getDiscussionPost(int $orgUntiId, int $forumId, int $topicId, int $postId): ?Post
	{
		$response = $this->apirequest("/d2l/api/le/" . self::VERSION_LE . "/$orgUntiId/discussions/forums/$forumId/topics/$topicId/posts/$postId", "GET");
		return $this->isValidResponseCode() ? new Post($response) : null;
	}
}
