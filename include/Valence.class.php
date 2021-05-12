<?php

use GuzzleHttp\Client;

class Valence {
	private $httpclient, $handler;
	public const VERSION_LP = 1.26;

	public function __construct()
	{
		$authContextFactory = new D2LAppContextFactory();
		$authContext = $authContextFactory->createSecurityContext($_ENV['D2L_VALENCE_APP_ID'], $_ENV['D2L_VALENCE_APP_KEY']);
		$hostSpec = new D2LHostSpec($_ENV['D2L_VALENCE_HOST'], $_ENV['D2L_VALENCE_PORT'], $_ENV['D2L_VALENCE_SCHEME']);
		$this->handler = $authContext->createUserContextFromHostSpec($hostSpec, $_ENV['D2L_VALENCE_USER_ID'], $_ENV['D2L_VALENCE_USER_KEY']);
		$this->httpclient = new Client(['base_uri' => "{$_ENV['D2L_VALENCE_SCHEME']}://{$_ENV['D2L_VALENCE_HOST']}'/"]);
	}

	public function apirequest(string $route, string $method = 'GET', array $data = null)
	{
		$uri = $this->handler->createAuthenticatedUri(str_replace(' ', '%20', $route), $method);
		$response = $this->httpclient->request($method, $uri, ['json' => $data]);
		$responseCode = $response->getStatusCode();
		return json_decode($response->getBody(), 1);
	}

	public function whoami() {
		return $this->apirequest("/d2l/api/lp/".self::VERSION_LP."/users/whoami");
	}

	public function versions() {
		return $this->apirequest("/d2l/api/versions/");
	}

	public function user($userid, $userclass = User::class) {
		return new $userclass($this, $userid);
	}

	public function course($orgid, $courseclass = Course::class) {
		return new $courseclass($this, $orgid);
	}

	public function getUserIdFromUsername(string $username) {
		try {
			$data = $this->apirequest("/d2l/api/lp/".self::VERSION_LP."/users/?username=$username");
			return $data['UserId'] ?? null;
		} catch(Exception $e) {
			return null;
		}
	}

	public function getUserIdFromOrgDefinedId(string $orgdefid) {
		try {
			$data = $this->apirequest("/d2l/api/lp/".self::VERSION_LP."/users/?orgDefinedId=$orgdefid");
			return $data['UserId'] ?? null;
		} catch(Exception $e) {
			return null;
		}
	}

	public function getOrgUnitIdFromCode(string $offeringcode, int $orgunittype) {
		try {
			$data = $this->apirequest("/d2l/api/lp/".self::VERSION_LP."/orgstructure/?orgUnitType=$orgunittype&exactOrgUnitCode=$offeringcode");
			return $data['Items'][0]['Identifier'] ?? null;
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
}
