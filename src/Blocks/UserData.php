<?php

namespace BrightspaceDevHelper\Valence\Block;

use BrightspaceDevHelper\DataHub\Model\User;
use BrightspaceDevHelper\Valence\Client\Valence;
use BrightspaceDevHelper\Valence\Object\DateTime;
use BrightspaceDevHelper\Valence\Object\NotInDatahub;
use BrightspaceDevHelper\Valence\Structure\Block;

class UserData extends Block
{
	public int|NotInDatahub $OrgId;
	public int $UserId;
	public string $FirstName;
	public ?string $MiddleName;
	public string $LastName;
	public string $UserName;
	public ?string $ExternalEmail;
	public ?string $OrgDefinedId;
	public string|NotInDatahub $UniqueIdentifier;
	public UserActivationData $Activation;
	public ?string $LastAccessedDate;
	public string|NotInDatahub|null $Pronouns;

	public function __construct(array $response, Valence $valence)
	{
		parent::__construct($response, ['Activation', 'LastAccessedDate']);
		$this->LastAccessedDate = $response['LastAccessedDate'] != '' ? DateTime::createFromIso8601($response['LastAccessedDate'], $valence)->getTimestamp() : null;
		$this->Activation = new UserActivationData($response['Activation']);
	}

	public static function fromDatahub(User $record, Valence $valence): UserData
	{
		$a = [
			'OrgId' => new NotInDatahub(),
			'UserId' => $record->UserId,
			'FirstName' => $record->FirstName,
			'MiddleName' => $record->MiddleName,
			'LastName' => $record->LastName,
			'UserName' => $record->UserName,
			'ExternalEmail' => $record->ExternalEmail,
			'OrgDefinedId' => $record->OrgDefinedId,
			'UniqueIdentifier' => new NotInDatahub(),
			'Activation' => ['IsActive' => (bool)$record->IsActive],
			'LastAccessedDate' => DateTime::createFromTimestamp($record->LastAccessed, $valence)->getIso8601(),
			'Pronouns' => new NotInDatahub()
		];

		return new UserData($a, $valence);
	}
}
