<?php

namespace BrightspaceDevHelper\Valence\BlockArray;

use BrightspaceDevHelper\Valence\Block\Role;
use BrightspaceDevHelper\Valence\Structure\BlockArray;

class RoleArray extends BlockArray
{
	public string $blockClass = Role::class;

	public function next(): ?Role
	{
		return parent::next();
	}
}
