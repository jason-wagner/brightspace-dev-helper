<?php

use GuzzleHttp\Client;

class Valence {
	private $httpclient, $handler, $responseType;
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

		$this->newUserClass = User::class;
		$this->newCourseClass = Course::class;
	}

	public function apirequest(string $route, string $method = 'GET', array $data = null) {
		$uri = $this->handler->createAuthenticatedUri(str_replace(' ', '%20', $route), $method);
		$response = $this->httpclient->request($method, $uri, ['json' => $data]);

		$this->responseCode = $response->getStatusCode();
		$this->responseBody = json_decode($response->getBody(), 1);

		if($this->responseType == 'body')
			return $this->responseBody;
		else if($this->responseType == 'code')
			return $this->responseCode;
		else
			return ['code' => $this->responseCode, 'body' => $this->responseBody];
	}

	public function getResponseType() {
		return $this->responseType;
	}

	public function setResponseType(string $type) {
		if(!in_array(strtolower($type), ['body', 'code', 'both']))
			return false;

		$this->responseType = strtolower($type);
		return true;
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

	public function getUserIdFromOrgDefinedId(string $orgdefid) {
		try {
			$data = $this->apirequest("/d2l/api/lp/".self::VERSION_LP."/users/?orgDefinedId=$orgdefid");
			return $this->lastResponseBody()['UserId'] ?? null;
		} catch(Exception $e) {
			return null;
		}
	}

	public function getOrgUnitIdFromCode(string $offeringcode, int $orgunittype) {
		try {
			$data = $this->apirequest("/d2l/api/lp/".self::VERSION_LP."/orgstructure/?orgUnitType=$orgunittype&exactOrgUnitCode=$offeringcode");
			return $this->lastResponseBody()['Items'][0]['Identifier'] ?? null;
		} catch(Exception $e) {
			return null;
		}
	}

	public function getOrgUnitIdFromOfferingCode(string $offeringcode) {
		return $this->getOrgUnitIdFromCode($offeringcode, 3);
	}

	public function getOrgUnitIdFromSemesterCode(string $semestercode) {
		return $this->getOrgUnitIdFromCode($semestercode, 5);
	}

	public function getOrgUnitIdFromTemplateCode(string $templatecode) {
		return $this->getOrgUnitIdFromCode($templatecode, 2);
	}

	public function getOrgUnitIdFromDepartmentCode(string $departmentcode) {
		return $this->getOrgUnitIdFromCode($departmentcode, 226);
	}

	public function enrollUser(int $orgunitid, int $userid, int $roleid) {
		$data = [
			'OrgUnitId' => $orgunitid,
			'UserId' => $userid,
			'RoleId' => $roleid
		];

		return $this->apirequest("/d2l/api/lp/".self::VERSION_LP."/enrollments/", "POST", $data);
	}

	public function getCourseOffering(int $orgid) {
		return $this->apirequest("/d2l/api/lp/".Valence::VERSION_LP."/courses/$orgid");
	}

	public function createCourseOffering(string $name, string $code, string $path, int $coursetemplateid, int $semesterid, ?string $startdate, ?string $enddate, ?int $localeid, bool $forcelocal, bool $showaddressbook, ?string $description_text, bool $canselfregister) {
		$data = [
			"Name" => $name,
			"Code" => $code,
			"Path" => $path,
			"CourseTemplateId" => $coursetemplateid,
			"SemesterId" => $semesterid,
			"StartDate" => $startdate,
			"EndDate" =>  $enddate,
			"LocaleId" => $localeid,
			"ForceLocale" => $forcelocal,
			"ShowAddressBook" => $showaddressbook,
			"Description" => ['Type' => 'Text', 'Content' => $description_text],
			"CanSelfRegister" => $canselfregister
		];

		return $this->apirequest("/d2l/api/lp/".self::VERSION_LP."/courses/", "POST", $data);
	}

	public function updateCourseOffering(int $orgid, string $name, string $code, ?string $startdate, ?string $enddate, bool $isactive, string $description_text) {
		$data = [
			"Name" => $name,
			"Code" => $code,
			"StartDate" => $startdate,
			"EndDate" =>  $enddate,
			"IsActive" => $isactive,
			"Description" => ['Type' => 'Text', 'Content' => $description_text]
		];

		return $this->apirequest("/d2l/api/lp/".self::VERSION_LP."/courses/286252", "PUT", $data);
	}

	public function deleteCourseOffering(int $orgid) {
		return $this->apirequest("/d2l/api/lp/".self::VERSION_LP."/courses/$orgid", "DELETE");
	}

	public function getUser(int $userid) {
		return $this->apirequest("/d2l/api/lp/".Valence::VERSION_LP."/profile/user/$userid");
	}
}
