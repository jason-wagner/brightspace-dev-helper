<?php

use GuzzleHttp\Client;
use GuzzleHttp\Exception\ClientException;
use GuzzleHttp\Exception\ServerException;

class Valence {
	private $httpclient, $handler, $returnObjectOnCreate, $logMode, $logFileHandler, $exitOnError;
	public const VERSION_LP = '1.30';
	public const VERSION_LE = '1.52';
	protected $responseCode;
	public $newUserClass, $newCourseClass, $roleIds, $orgtypeIds;

	public function __construct() {
		$authContextFactory = new D2LAppContextFactory();
		$authContext = $authContextFactory->createSecurityContext($_ENV['D2L_VALENCE_APP_ID'], $_ENV['D2L_VALENCE_APP_KEY']);
		$hostSpec = new D2LHostSpec($_ENV['D2L_VALENCE_HOST'], $_ENV['D2L_VALENCE_PORT'], $_ENV['D2L_VALENCE_SCHEME']);
		$this->handler = $authContext->createUserContextFromHostSpec($hostSpec, $_ENV['D2L_VALENCE_USER_ID'], $_ENV['D2L_VALENCE_USER_KEY']);
		$this->httpclient = new Client(['base_uri' => "{$_ENV['D2L_VALENCE_SCHEME']}://{$_ENV['D2L_VALENCE_HOST']}'/"]);

		$this->responseCode = null;
		$this->returnObjectOnCreate = false;
		$this->exitOnError = true;
		$this->logMode = 0;
		$this->logFileHandler = null;

		$this->newUserClass = User::class;
		$this->newCourseClass = Course::class;

		$this->roleIds = [];
		$this->orgtypeIds = [];
	}

	public function apirequest(string $route, string $method = 'GET', ?array $data = null): array {
		$uri = $this->handler->createAuthenticatedUri(str_replace(' ', '%20', $route), $method);

		try {
			$response = $this->httpclient->request($method, $uri, ['json' => $data]);

			$this->responseCode = $response->getStatusCode();
			$responseBody = json_decode($response->getBody(), 1);

			if($this->logMode == 2 || ($this->logMode == 1 && in_array($method, ['POST', 'PUT', 'DELETE'])))
				$this->logrequest($route, $method, $data);
		} catch(ClientException | ServerException $exception) {
			$response = $exception->getResponse();

			$this->responseCode = $response->getStatusCode();
			$responseBody = $response->getBody()->getContents();

			if($this->logMode == 2 || ($this->logMode == 1 && in_array($method, ['POST', 'PUT', 'DELETE'])))
				$this->logrequest($route, $method, $data);

			if($this->exitOnError) {
				fwrite(STDERR, "Error: {$this->responseCode} {$responseBody} (exiting...)\n");
				exit(1);
			}
		}

		return $responseBody;
	}

	private function logrequest(string $route, string $method, ?array $data): void {
		$logEntry = date("Y-m-d H:i:s") . " $method $route " . json_encode($data ?? []) . " $this->responseCode\n";
		fwrite($this->logFileHandler, $logEntry);
	}

	public function setLogging(int $logMode, ?string $logFile = null): void {
		$this->logMode = $logMode;

		if($this->logFileHandler)
			fclose($this->logFileHandler);

		$this->logFileHandler = fopen($logFile ?? 'valence.log', 'a');
	}

	public function setReturnObjectOnCreate(bool $returnobject): void {
		$this->returnObjectOnCreate = $returnobject;
	}

	public function setExitOnError(bool $exitonerror): void {
		$this->exitOnError = $exitonerror;
	}

	public function responseCode(): int {
		return $this->responseCode;
	}

	public function setUserClass($userclass): void {
		$this->newUserClass = $userclass;
	}

	public function setCourseClass($courseclass): void {
		$this->newCourseClass = $courseclass;
	}

	public function setInternalIds(): void {
		foreach ($this->getRoles()['body'] as $role)
			$this->roleIds[$role['DisplayName']] = $role['Identifier'];

		foreach($this->getOrgUnitTypes()['body'] as $orgtype)
			$this->orgtypeIds[$orgtype['Code']] = $orgtype['Id'];
	}

	public function whoami(): array {
		return $this->apirequest("/d2l/api/lp/".self::VERSION_LP."/users/whoami");
	}

	public function versions(): array {
		return $this->apirequest("/d2l/api/versions/");
	}

	public function getRoles(): array {
		return $this->apirequest("/d2l/api/lp/".self::VERSION_LP."/{$_ENV['D2L_VALENCE_ROOT_ORGID']}/roles/");
	}

	public function getOrgUnitTypes(): array {
		return $this->apirequest("/d2l/api/lp/".self::VERSION_LP."/outypes/");
	}

	public function user(int $userid): User {
		return new $this->newUserClass($this, $userid);
	}

	public function course(int $orgid): Course {
		return new $this->newCourseClass($this, $orgid);
	}

	public function getUserIdFromUsername(string $username): ?int {
		try {
			$data = $this->apirequest("/d2l/api/lp/".self::VERSION_LP."/users/?username=$username");
			return $this->lastResponseBody()['UserId'] ?? null;
		} catch(Exception $e) {
			return null;
		}
	}

	public function getUserIdFromOrgDefinedId(string $orgDefinedId): ?int {
		try {
			$data = $this->apirequest("/d2l/api/lp/".self::VERSION_LP."/users/?orgDefinedId=$orgDefinedId");
			return $this->lastResponseBody()['UserId'] ?? null;
		} catch(Exception $e) {
			return null;
		}
	}

	public function getOrgUnitIdFromCode(string $orgUnitCode, int $orgUnitType): ?int {
		try {
			$data = $this->apirequest("/d2l/api/lp/".self::VERSION_LP."/orgstructure/?orgUnitType=$orgUnitType&exactOrgUnitCode=$orgUnitCode");
			return $this->lastResponseBody()['Items'][0]['Identifier'] ?? null;
		} catch(Exception $e) {
			return null;
		}
	}

	public function getOrgUnitIdFromOfferingCode(string $offeringCode): ?int {
		if(!count($this->orgtypeIds))
			$this->setInternalIds();

		return $this->getOrgUnitIdFromCode($offeringCode, $this->orgtypeIds['Course Offering']);
	}

	public function getOrgUnitIdFromSemesterCode(string $semesterCode): ?int {
		if(!count($this->orgtypeIds))
			$this->setInternalIds();

		return $this->getOrgUnitIdFromCode($semesterCode, $this->orgtypeIds['Semester']);
	}

	public function getOrgUnitIdFromTemplateCode(string $templateCode): ?int {
		if(!count($this->orgtypeIds))
			$this->setInternalIds();

		return $this->getOrgUnitIdFromCode($templateCode, $this->orgtypeIds['Course Template']);
	}

	public function getOrgUnitIdFromDepartmentCode(string $departmentCode): ?int {
		if(!count($this->orgtypeIds))
			$this->setInternalIds();

		return $this->getOrgUnitIdFromCode($departmentCode, $this->orgtypeIds['Department']);
	}

	public function enrollUser(int $OrgUnitId, int $UserId, int $RoleId): array {
		$data = compact('OrgUnitId', 'UserId', 'RoleId');

		return $this->apirequest("/d2l/api/lp/".self::VERSION_LP."/enrollments/", "POST", $data);
	}

	public function unenrollUser(int $userId, int $orgUnitId): array {
		return $this->apirequest("/d2l/api/lp/".self::VERSION_LP."/enrollments/users/$userId/orgUnits/$orgUnitId", "DELETE");
	}

	public function getEnrollment(int $orgUnitId, int $userId): array {
		return $this->apirequest("/d2l/api/lp/".self::VERSION_LP."/enrollments/orgUnits/$orgUnitId/users/$userId");
	}

	public function enrollStudent(int $OrgUnitId, int $UserId): array {
		if(!count($this->roleIds))
			$this->setInternalIds();

		return $this->enrollUser($OrgUnitId, $UserId, $this->roleIds['Student']);
	}

	public function enrollInstructor(int $OrgUnitId, int $UserId): array {
		if(!count($this->roleIds))
			$this->setInternalIds();

		return $this->enrollUser($OrgUnitId, $UserId, $this->roleIds['Instructor']);
	}

	public function getCourseOffering(int $orgUnitId): array {
		return $this->apirequest("/d2l/api/lp/".self::VERSION_LP."/courses/$orgUnitId");
	}

	public function createCourseOffering(string $Name, string $Code, string $Path, int $CourseTemplateId, int $SemesterId, ?string $StartDate, ?string $EndDate, ?int $LocaleId, bool $ForceLocale, bool $ShowAddressBook, ?string $DescriptionText, bool $CanSelfRegister) {
		$data = compact('Name', 'Code', 'Path', 'CourseTemplateId', 'SemesterId', 'StartDate', 'EndDate', 'LocaleId', 'ForceLocale', 'ShowAddressBook', 'CanSelfRegister');
		$data['Description'] = ['Type' => 'Text', 'Content' => $DescriptionText];

		$response = $this->apirequest("/d2l/api/lp/".self::VERSION_LP."/courses/", "POST", $data);

		return $this->returnObjectOnCreate ? $this->course($response['Identifier']) : $response;
	}

	public function updateCourseOffering(int $orgUnitId, string $Name, string $Code, ?string $StartDate, ?string $EndDate, bool $IsActive, string $DescriptionText): array {
		$data = compact('Name', 'Code', 'StartDate', 'EndDate', 'IsActive');
		$data['Description'] = ['Type' => 'Text', 'COntent' => $DescriptionText];

		return $this->apirequest("/d2l/api/lp/".self::VERSION_LP."/courses/$orgUnitId", "PUT", $data);
	}

	public function deleteCourseOffering(int $orgUnitId): array {
		return $this->apirequest("/d2l/api/lp/".self::VERSION_LP."/courses/$orgUnitId", "DELETE");
	}

	public function getCourseSections(int $orgUnitId): array {
		return $this->apirequest("/d2l/api/lp/".self::VERSION_LP."/$orgUnitId/sections/");
	}

	public function getCourseSection(int $orgUnitId, int $sectionId): array {
		return $this->apirequest("/d2l/api/lp/".self::VERSION_LP."/$orgUnitId/sections/$sectionId");
	}

	public function createCourseSection(int $orgUnitId, string $Name, string $Code, string $DescriptionText): array {
		$data = compact('Name', 'Code');
		$data['Description'] = ['Type' => 'Text', 'Content' => $DescriptionText];

		return $this->apirequest("/d2l/api/lp/".self::VERSION_LP."/$orgUnitId)/sections/", "POST", $data);
	}

	public function updateCourseSection(int $orgUnitId, int $sectionId, string $Name, string $Code, string $DescriptionText): array {
		$data = compact('Name', 'Code');
		$data['Description'] = ['Type' => 'Text', 'Content' => $DescriptionText];

		return $this->apirequest("/d2l/api/lp/".self::VERSION_LP."/$orgUnitId/sections/$sectionId", "PUT", $data);
	}

	public function initializeCourseSections(int $orgUnitId, int $EnrollmentStyle, int $EnrollmentQuantity, bool $AuthEnroll, bool $RandomizeEnrollments): array {
		$data = compact('EnrollmentStyle', 'EnrollmentQuantity', 'AuthEnroll', 'RandomizeEnrollments');
		return $this->apirequest("/d2l/api/lp/".self::VERSION_LP."/$orgUnitId/sections/", "PUT", $data);
	}

	public function deleteCourseSection(int $orgUnitId, int $sectionId): array {
		return $this->apirequest("/d2l/api/lp/".self::VERSION_LP."/$orgUnitId/sections/$sectionId", "DELETE");
	}

	public function enrollUserInCourseSection(int $orgUnitId, int $sectionId, int $UserId): array {
		$data = compact('UserId');
		return $this->apirequest("/d2l/api/lp/".self::VERSION_LP."/$orgUnitId/sections/$sectionId/enrollments/", "POST", $data);
	}

	public function getCourseSectionSettings(int $orgUnitId): array {
		return $this->apirequest("/d2l/api/lp/".self::VERSION_LP."/$orgUnitId/sections/settings");
	}

	public function updateCourseSectionSettings(int $orgUnitId, int $EnrollmentStyle, int $EnrollmentQuantity, int $AuthEnroll, int $RandomizeEnrollments): array {
		$data = compact('EnrollmentStyle', 'EnrollmentQuantity', 'AuthEnroll', 'RandomizeEnrollments');
		return $this->apirequest("/d2l/api/lp/".self::VERSION_LP."/$orgUnitId/sections/settings", "PUT", $data);
	}

	public function getCourseGroupCategories(int $orgUnitId): array {
		return $this->apirequest("/d2l/api/lp/".self::VERSION_LP."/$orgUnitId/groupcategories/");
	}

	public function getCourseGroupCategory(int $orgUnitId, int $groupCategoryId): array {
		return $this->apirequest("/d2l/api/lp/".self::VERSION_LP."/$orgUnitId/groupcategories/$groupCategoryId");
	}

	public function createCourseGroupCategory(int $orgUnitId, string $Name, string $DescriptionText, int $EnrollmentStyle, ?int $EnrollmentQuantity, bool $AutoEnroll, bool $RandomizeEnrollments, ?int $NumberOfGroups, ?int $MaxUsersPerGroup, bool $AllocateAfterExpiry, ?string $SelfEnrollmentExpiryDate, ?string $GroupPrefix, ?int $RestrictedByOrgUnitId): array {
		$data = compact('Name', 'EnrollmentStyle', 'EnrollmentQuantity', 'AutoEnroll', 'RandomizeEnrollments', 'NumberOfGroups', 'MaxUsersPerGroup', 'AllocateAfterExpiry', 'SelfEnrollmentExpiryDate', 'GroupPrefix', 'RestrictedByOrgUnitId');
		$data['Description'] = ['Type' => 'Text', 'Content' => $DescriptionText];

		return $this->apirequest("/d2l/api/lp/".self::VERSION_LP."/$orgUnitId/groupcategories/", "POST", $data);
	}

	public function deleteCourseGroupCategory(int $orgUnitId, int $groupCategoryId): array {
		return $this->apirequest("/d2l/api/lp/".self::VERSION_LP."/$orgUnitId/groupcategories/$groupCategoryId", "DELETE");
	}

	public function updateCourseGroupCategory(int $orgUnitId, int $groupCategoryId, string $Name, string $DescriptionText, int $EnrollmentStyle, ?int $EnrollmentQuantity, bool $AutoEnroll, bool $RandomizeEnrollments, ?int $NumberOfGroups, ?int $MaxUsersPerGroup, bool $AllocateAfterExpiry, ?string $SelfEnrollmentExpiryDate, ?string $GroupPrefix, ?int $RestrictedByOrgUnitId): array {
		$data = compact('Name', 'EnrollmentStyle', 'EnrollmentQuantity', 'AutoEnroll', 'RandomizeEnrollments', 'NumberOfGroups', 'MaxUsersPerGroup', 'AllocateAfterExpiry', 'SelfEnrollmentExpiryDate', 'GroupPrefix', 'RestrictedByOrgUnitId');
		$data['Description'] = ['Type' => 'Text', 'Content' => $DescriptionText];

		return $this->apirequest("/d2l/api/lp/".self::VERSION_LP."/$orgUnitId/groupcategories/$groupCategoryId", "PUT", $data);
	}

	public function getCourseGroups(int $orgUnitId, int $groupCategoryId): array {
		return $this->apirequest("/d2l/api/lp/".self::VERSION_LP."/$orgUnitId/groupcategories/$groupCategoryId/groups/");
	}

	public function getCourseGroup(int $orgUnitId, int $groupCategoryId, int $groupId): array {
		return $this->apirequest("/d2l/api/lp/".self::VERSION_LP."/$orgUnitId/groupcategories/$groupCategoryId/groups/$groupId");
	}

	public function createCourseGroup(int $orgUnitId, int $groupCategoryId, string $Name, string $Code, string $DescriptionText): array {
		$data = compact('Name', 'Code');
		$data['Description'] = ['Type' => 'Text', 'Content' => $DescriptionText];
		return $this->apirequest("/d2l/api/lp/".self::VERSION_LP."/$orgUnitId/groupcategories/$groupCategoryId/groups/", "POST", $data);
	}

	public function updateCourseGroup(int $orgUnitId, int $groupCategoryId, int $groupId, string $Name, string $Code, string $DescriptionText): array {
		$data = compact('Name', 'Code');
		$data['Description'] = ['Type' => 'Text', 'Content' => $DescriptionText];
		return $this->apirequest("/d2l/api/lp/".self::VERSION_LP."/$orgUnitId/groupcategories/$groupCategoryId/groups/$groupId", "PUT", $data);
	}

	public function enrollUserInGroup(int $orgUnitId, int $groupCategoryId, int $groupId, int $UserId): array {
		$data = compact('UserId');
		return $this->apirequest("/d2l/api/lp/".self::VERSION_LP."/$orgUnitId/groupcategories/$groupCategoryId/groups/$groupId/enrollments/", "POST", $data);
	}

	public function unenrollUserFromGroup(int $orgUnitId, int $groupCategoryId, int $groupId, int $userId): array {
		return $this->apirequest("/d2l/api/lp/".self::VERSION_LP."/$orgUnitId/groupcategories/$groupCategoryId/groups/$groupId/enrollments/$userId");
	}

	public function deleteCourseGroup(int $orgUnitId, int $groupCategoryId, int $groupId): array {
		return $this->apirequest("/d2l/api/lp/".self::VERSION_LP."/$orgUnitId/groupcategories/$groupCategoryId/groups/$groupId", "DELETE");
	}

	public function getUser(int $userId): array {
		return $this->apirequest("/d2l/api/lp/".self::VERSION_LP."/users/$userId");
	}

	public function getUserNames(int $userId): array {
		return $this->apirequest("/d2l/api/lp/".self::VERSION_LP."/users/$userId/names");
	}

	public function updateUserNames(int $userId, string $LegalFirstName, string $LegalLastName, ?string $PreferredFirstName, ?string $PreferredLastName): array {
		$data = compact('LegalFirstName', 'LegalLastName', 'PreferredFirstName', 'PreferredLastName');
		return $this->apirequest("/d2l/api/lp/".self::VERSION_LP."/users/$userId/names", "PUT", $data);
	}

	public function getUserProfile(int $userId): array {
		return $this->apirequest("/d2l/api/lp/".self::VERSION_LP."/profile/user/$userId");
	}
}
