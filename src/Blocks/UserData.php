<?php

namespace BrightspaceDevHelper\Valence\Block;

use BrightspaceDevHelper\Valence\Structure\Block;

class UserData extends Block
{
	public int $OrgId;
	public int $UserId;
	public string $FirstName;
	public ?string $MiddleName;
	public string $LastName;
	public string $UserName;
	public ?string $ExternalEmail;
	public ?string $OrgDefinedId;
	public string $UniqueIdentifier;
	public UserActivationData $Activation;
	public ?string $LastAccessedDate;
	public string $Pronouns;

	public function __construct(array $response)
	{
		parent::__construct($response, ['Activation']);
		$this->Activation = new UserActivationData($response['Activation']);
	}

}
