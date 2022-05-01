<?php

namespace BrightspaceDevHelper\Valence\Block;

use BrightspaceDevHelper\Valence\Structure\Block;

class OrgUnitType extends Block
{
	public $Id;
	public $Code;
	public $Name;
	public $Description;
	public $SortOrder;
	public $Permissions;

	public function __construct(array $response)
	{
		parent::__construct($response, ['Permissions']);
		$this->Permissions = new Permissions($response['Permissions']);
	}
}
