<?php

namespace BrightspaceDevHelper\Valence\Block;

use BrightspaceDevHelper\Valence\Structure\Block;

class UserData extends Block
{
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

	public function __construct(array $response)
	{
		parent::__construct($response, ['Activation']);
		$this->Activation = new UserActivationData($response['Activation']);
	}

}
