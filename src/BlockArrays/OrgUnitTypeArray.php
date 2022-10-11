<?php

namespace BrightspaceDevHelper\Valence\BlockArray;

use BrightspaceDevHelper\Valence\Block\OrgUnitType;
use BrightspaceDevHelper\Valence\Structure\BlockArray;

class OrgUnitTypeArray extends BlockArray
{
	public string $blockClass = OrgUnitType::class;

	public function current(): ?OrgUnitType
	{
		return parent::current();
	}
}
