<?php

namespace BrightspaceDevHelper\Valence\BlockArray;

use BrightspaceDevHelper\Valence\Block\Role;
use BrightspaceDevHelper\Valence\Structure\BlockArray;

class RoleArray extends BlockArray
{
	public function __construct(array $response)
	{
		$this->data = [];

		foreach ($response as $block)
			$this->data[] = new Role($block);
	}

	public function next(): ?Role
	{
		return $this->data[$this->pointer++] ?? null;
	}
}
