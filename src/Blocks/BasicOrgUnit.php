<?php

namespace BrightspaceDevHelper\Valence\Block;

use BrightspaceDevHelper\DataHub\Model\OrganizationalUnit;
use BrightspaceDevHelper\Valence\Structure\Block;

class BasicOrgUnit extends Block
{
	public string $Identifier;
	public string $Name;
	public string $Code;

	public static function fromDatahub(OrganizationalUnit $record): BasicOrgUnit
	{
		return new BasicOrgUnit([
			'Identifier' => $record->OrgUnitId,
			'Name' => $record->Name,
			'Code' => $record->Code
		]);
	}
}
