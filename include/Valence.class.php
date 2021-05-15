<?php

use GuzzleHttp\Client;

class Valence {
	private $httpclient, $handler, $responseType, $returnObjectOnCreate, $logMode, $logFileHandler;
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
		$this->responseType = 'body';
		$this->returnObjectOnCreate = false;
		$this->logMode = 0;
		$this->logFileHandler = null;

		$this->newUserClass = User::class;
		$this->newCourseClass = Course::class;
	}

	public function apirequest(string $route, string $method = 'GET', array $data = null) {
		$uri = $this->handler->createAuthenticatedUri(str_replace(' ', '%20', $route), $method);
		$response = $this->httpclient->request($method, $uri, ['json' => $data]);

		$this->responseCode = $response->getStatusCode();
		$this->responseBody = json_decode($response->getBody(), 1);

		if($this->logMode == 2 || ($this->logMode == 1 && in_array($method, ['POST', 'PUT', 'DELETE'])))
			$this->logrequest($route, $method, $data);

		if($this->responseType == 'body')
			return $this->responseBody;
		else if($this->responseType == 'code')
			return $this->responseCode;
		else
			return ['code' => $this->responseCode, 'body' => $this->responseBody];
	}

	private function logrequest(string $route, string $method, ?array $data) {
		$logEntry = date("Y-m-d H:i:s") . " $method $route " . json_encode($data ?? []) . " $this->responseCode\n";
		fwrite($this->logFileHandler, $logEntry);
	}

	public function getResponseType() {
		return $this->responseType;
	}

	public function setLogging(int $logMode, ?string $logFile = null) {
		$this->logMode = $logMode;

		if($this->logFileHandler)
			fclose($this->logFileHandler);

		$this->logFileHandler = fopen($logFile ?? 'valence.log', 'a');
	}

	public function setResponseType(string $type) {
		if(!in_array(strtolower($type), ['body', 'code', 'both']))
			return false;

		$this->responseType = strtolower($type);
		return true;
	}

	public function setReturnObjectOnCreate(bool $returnobject) {
		$this->returnObjectOnCreate = $returnobject;
	}

	public function lastResponseCode() {
		return $this->responseCode;
	}

	public function lastResponseBody() {
		return $this->responseBody;
	}

	public function setUserClass($userclass) {
		$this->newUserClass = $userclass;
	}

	public function setCourseClass($courseclass) {
		$this->newCourseClass = $courseclass;
	}

	public function whoami() {
		return $this->apirequest("/d2l/api/lp/".self::VERSION_LP."/users/whoami");
	}

	public function versions() {
		return $this->apirequest("/d2l/api/versions/");
	}

	public function user(int $userid) {
		return new $this->newUserClass($this, $userid);
	}

	public function course(int $orgid) {
		return new $this->newCourseClass($this, $orgid);
	}

	public function getUserIdFromUsername(string $username) {
		try {
			$data = $this->apirequest("/d2l/api/lp/".self::VERSION_LP."/users/?username=$username");
			return $this->lastResponseBody()['UserId'] ?? null;
		} catch(Exception $e) {
			return null;
		}
	}

	public function getUserIdFromOrgDefinedId(string $orgDefinedId) {
		try {
			$data = $this->apirequest("/d2l/api/lp/".self::VERSION_LP."/users/?orgDefinedId=$orgDefinedId");
			return $this->lastResponseBody()['UserId'] ?? null;
		} catch(Exception $e) {
			return null;
		}
	}

	public function getOrgUnitIdFromCode(string $orgUnitCode, int $orgUnitType) {
		try {
			$data = $this->apirequest("/d2l/api/lp/".self::VERSION_LP."/orgstructure/?orgUnitType=$orgUnitType&exactOrgUnitCode=$orgUnitCode");
			return $this->lastResponseBody()['Items'][0]['Identifier'] ?? null;
		} catch(Exception $e) {
			return null;
		}
	}

	public function getOrgUnitIdFromOfferingCode(string $offeringCode) {
		return $this->getOrgUnitIdFromCode($offeringCode, 3);
	}

	public function getOrgUnitIdFromSemesterCode(string $semesterCode) {
		return $this->getOrgUnitIdFromCode($semesterCode, 5);
	}

	public function getOrgUnitIdFromTemplateCode(string $templateCode) {
		return $this->getOrgUnitIdFromCode($templateCode, 2);
	}

	public function getOrgUnitIdFromDepartmentCode(string $departmentCode) {
		return $this->getOrgUnitIdFromCode($departmentCode, 226);
	}

	public function enrollUser(int $OrgUnitId, int $UserId, int $RoleId) {
		$data = compact('OrgUnitId', 'UserId', 'RoleId');

		return $this->apirequest("/d2l/api/lp/".self::VERSION_LP."/enrollments/", "POST", $data);
	}

	public function getCourseOffering(int $orgUnitId) {
		return $this->apirequest("/d2l/api/lp/".Valence::VERSION_LP."/courses/$orgUnitId");
	}

	public function createCourseOffering(string $Name, string $Code, string $Path, int $CourseTemplateId, int $SemesterId, ?string $StartDate, ?string $EndDate, ?int $LocaleId, bool $ForceLocale, bool $ShowAddressBook, ?string $DescriptionText, bool $CanSelfRegister) {
		$data = compact('Name', 'Code', 'Path', 'CourseTemplateId', 'SemesterId', 'StartDate', 'EndDate', 'LocaleId', 'ForceLocale', 'ShowAddressBook', 'CanSelfRegister');
		$data['Description'] = ['Type' => 'Text', 'Content' => $DescriptionText];

		$response = $this->apirequest("/d2l/api/lp/".self::VERSION_LP."/courses/", "POST", $data);

		return $this->returnObjectOnCreate ? $this->course($response['Identifier']) : $response;
	}

	public function updateCourseOffering(int $orgUnitId, string $Name, string $Code, ?string $StartDate, ?string $EndDate, bool $IsActive, string $DescriptionText) {
		$data = compact('Name', 'Code', 'StartDate', 'EndDate', 'IsActive');
		$data['Description'] = ['Type' => 'Text', 'COntent' => $DescriptionText];

		return $this->apirequest("/d2l/api/lp/".self::VERSION_LP."/courses/$orgUnitId", "PUT", $data);
	}

	public function deleteCourseOffering(int $orgUnitId) {
		return $this->apirequest("/d2l/api/lp/".self::VERSION_LP."/courses/$orgUnitId", "DELETE");
	}

	public function getUser(int $userId) {
		return $this->apirequest("/d2l/api/lp/".Valence::VERSION_LP."/users/$userId");
	}

	public function getUserProfile(int $userId) {
		return $this->apirequest("/d2l/api/lp/".Valence::VERSION_LP."/profile/user/$userId");
	}
}
