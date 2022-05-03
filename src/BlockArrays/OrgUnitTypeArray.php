<?php

namespace BrightspaceDevHelper\Valence\BlockArray;

use BrightspaceDevHelper\Valence\Block\OrgUnitType;
use BrightspaceDevHelper\Valence\Structure\BlockArray;

class OrgUnitTypeArray extends BlockArray
{
	public $blockClass = OrgUnitType::class;

	public function next(): ?OrgUnitType
	{
		return parent::next();
	}
}
