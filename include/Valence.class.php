<?php

use GuzzleHttp\Client;
use GuzzleHttp\Exception\ClientException;
use GuzzleHttp\Exception\ServerException;

class Valence {
	private $httpclient, $handler, $returnObjectOnCreate, $logMode, $logFileHandler, $exitOnError;
	public const VERSION_LP = 1.30;
	public const VERSION_LE = 1.52;
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
		$this->exitOnError = true;
		$this->logMode = 0;
		$this->logFileHandler = null;

		$this->newUserClass = User::class;
		$this->newCourseClass = Course::class;
	}

	public function apirequest(string $route, string $method = 'GET', ?array $data = null): array {
		$uri = $this->handler->createAuthenticatedUri(str_replace(' ', '%20', $route), $method);

		try {
			$response = $this->httpclient->request($method, $uri, ['json' => $data]);

			$this->responseCode = $response->getStatusCode();
			$this->responseBody = json_decode($response->getBody(), 1);

			if($this->logMode == 2 || ($this->logMode == 1 && in_array($method, ['POST', 'PUT', 'DELETE'])))
				$this->logrequest($route, $method, $data);
		} catch(ClientException | ServerException $exception) {
			$response = $exception->getResponse();

			$this->responseCode = $response->getStatusCode();
			$this->responseBody = $response->getBody()->getContents();

			if($this->logMode == 2 || ($this->logMode == 1 && in_array($method, ['POST', 'PUT', 'DELETE'])))
				$this->logrequest($route, $method, $data);

			if($this->exitOnError) {
				fwrite(STDERR, "Error: {$this->responseCode} {$this->responseBody} (exiting...)\n");
				exit(1);
			}
		}

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

	public function setExitOnError(bool $exitonerror): void {
		$this->exitOnError = $exitonerror;
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
		return $this->getOrgUnitIdFromCode($offeringCode, $_ENV['D2L_VALENCE_ORGUNITTYPEID_COURSEOFFERING']);
	}

	public function getOrgUnitIdFromSemesterCode(string $semesterCode): ?int {
		return $this->getOrgUnitIdFromCode($semesterCode, $_ENV['D2L_VALENCE_ORGUNITTYPEID_SEMESTER']);
	}

	public function getOrgUnitIdFromTemplateCode(string $templateCode): ?int {
		return $this->getOrgUnitIdFromCode($templateCode, $_ENV['D2L_VALENCE_ORGUNITTYPEID_TEMPLATE']);
	}

	public function getOrgUnitIdFromDepartmentCode(string $departmentCode): ?int {
		return $this->getOrgUnitIdFromCode($departmentCode, $_ENV['D2L_VALENCE_ORGUNITTYPEID_DEPARTMENT']);
	}

	public function enrollUser(int $OrgUnitId, int $UserId, int $RoleId): array {
		$data = compact('OrgUnitId', 'UserId', 'RoleId');

		return $this->apirequest("/d2l/api/lp/".self::VERSION_LP."/enrollments/", "POST", $data);
	}

	public function enrollStudent(int $OrgUnitId, int $UserId): array {
		return $this->enrollUser($OrgUnitId, $UserId, $_ENV['D2L_VALENCE_ROLEID_STUDENT']);
	}

	public function enrollInstructor(int $OrgUnitId, int $UserId): array {
		return $this->enrollUser($OrgUnitId, $UserId, $_ENV['D2L_VALENCE_ROLEID_INSTRUCTOR']);
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

	public function getUser(int $userId): array {
		return $this->apirequest("/d2l/api/lp/".self::VERSION_LP."/users/$userId");
	}

	public function getUserProfile(int $userId): array {
		return $this->apirequest("/d2l/api/lp/".self::VERSION_LP."/profile/user/$userId");
	}
}
