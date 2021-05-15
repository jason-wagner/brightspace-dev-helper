<?php

use GuzzleHttp\Client;

class Valence {
	private $httpclient, $handler, $returnObjectOnCreate, $logMode, $logFileHandler;
	public const VERSION_LP = 1.26;
	protected $responseBody, $responseCode;
	public $newUserClass, $newCourseClass;

	public function __construct() {
		$authContextFactory = new D2LAppContextFactory();
		$authContext = $authContextFactory->createSecurityContext($_ENV['D2L_VALENCE_APP_ID'], $_ENV['D2L_VALENCE_APP_KEY']);
		$hostSpec = new D2LHostSpec($_ENV['D2L_VALENCE_HOST'], $_ENV['D2L_VALENCE_PORT'], $_ENV['D2L_VALENCE_SCHEME']);
		$this->handler = $authContext->createUserContextFromHostSpec($hostSpec, $_ENV['D2L_VALENCE_USER_ID'], $_ENV['D2L_VALENCE_USER_KEY']);
		$this->httpclient = new Client(['base_uri' => "{$_ENV['D2L_VALENCE_SCHEME']}://{$_ENV['D2L_VALENCE_HOST']}'/"]);

		$this->responseCode = null;
		$this->responseBody = null;
		$this->returnObjectOnCreate = false;
		$this->logMode = 0;
		$this->logFileHandler = null;

		$this->newUserClass = User::class;
		$this->newCourseClass = Course::class;
	}

	public function apirequest(string $route, string $method = 'GET', ?array $data = null): array {
		$uri = $this->handler->createAuthenticatedUri(str_replace(' ', '%20', $route), $method);
		$response = $this->httpclient->request($method, $uri, ['json' => $data]);

		$this->responseCode = $response->getStatusCode();
		$this->responseBody = json_decode($response->getBody(), 1);

		if($this->logMode == 2 || ($this->logMode == 1 && in_array($method, ['POST', 'PUT', 'DELETE'])))
			$this->logrequest($route, $method, $data);

		return ['code' => $this->responseCode, 'body' => $this->responseBody];
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

	public function lastResponseCode(): int {
		return $this->responseCode;
	}

	public function lastResponseBody(): array {
		return $this->responseBody;
	}

	public function setUserClass($userclass): void {
		$this->newUserClass = $userclass;
	}

	public function setCourseClass($courseclass): void {
		$this->newCourseClass = $courseclass;
	}

	public function whoami(): array {
		return $this->apirequest("/d2l/api/lp/".self::VERSION_LP."/users/whoami");
	}

	public function versions(): array {
		return $this->apirequest("/d2l/api/versions/");
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
		return $this->getOrgUnitIdFromCode($offeringCode, 3);
	}

	public function getOrgUnitIdFromSemesterCode(string $semesterCode): ?int {
		return $this->getOrgUnitIdFromCode($semesterCode, 5);
	}

	public function getOrgUnitIdFromTemplateCode(string $templateCode): ?int {
		return $this->getOrgUnitIdFromCode($templateCode, 2);
	}

	public function getOrgUnitIdFromDepartmentCode(string $departmentCode): ?int {
		return $this->getOrgUnitIdFromCode($departmentCode, 226);
	}

	public function enrollUser(int $OrgUnitId, int $UserId, int $RoleId): array {
		$data = compact('OrgUnitId', 'UserId', 'RoleId');

		return $this->apirequest("/d2l/api/lp/".self::VERSION_LP."/enrollments/", "POST", $data);
	}

	public function getCourseOffering(int $orgUnitId): array {
		return $this->apirequest("/d2l/api/lp/".Valence::VERSION_LP."/courses/$orgUnitId");
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

	public function deleteCourseOffering(int $orgUnitId) {
		return $this->apirequest("/d2l/api/lp/".self::VERSION_LP."/courses/$orgUnitId", "DELETE");
	}

	public function getUser(int $userId): array {
		return $this->apirequest("/d2l/api/lp/".Valence::VERSION_LP."/users/$userId");
	}

	public function getUserProfile(int $userId): array {
		return $this->apirequest("/d2l/api/lp/".Valence::VERSION_LP."/profile/user/$userId");
	}
}
