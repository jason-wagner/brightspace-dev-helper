<?php

namespace BrightspaceDevHelper\Valence\Block;

use BrightspaceDevHelper\Valence\Structure\Block;

class OrgUnitType extends Block
{
	public int $Id;
	public string $Code;
	public string $Name;
	public string $Description;
	public int $SortOrder;
	public Permissions $Permissions;

	public function __construct(array $response)
	{
		parent::__construct($response, ['Permissions']);
		$this->Permissions = new Permissions($response['Permissions']);
	}
}
