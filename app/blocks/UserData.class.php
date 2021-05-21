<?php

namespace ValenceHelper\Block;

use ValenceHelper\Block;

class UserData extends Block {
	public $OrgId;
	public $UserId;
	public $FirstName;
	public $MiddleName;
	public $LastName;
	public $UserName;
	public $ExternalEmail;
	public $OrgDefinedId;
	public $UniqueIdentifier;
	public $Activation;
	public $LastAccessedDate;

	public function __construct(array $response) {
		foreach(['OrgId', 'UserId', 'FirstName', 'MiddleName', 'LastName', 'UserName', 'ExternalEmail', 'OrgDefinedId', 'UniqueIdentifier', 'LastAccessedDate'] as $key)
			$this->$key = $response[$key];

		$this->Activation = new UserActivationData($response['Activation']);
	}

}
