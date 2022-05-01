<?php

namespace BrightspaceDevHelper\Valence\BlockArray;

use BrightspaceDevHelper\Valence\Block\OrgUnitType;
use BrightspaceDevHelper\Valence\Structure\BlockArray;

class OrgUnitTypeArray extends BlockArray
{
	public function __construct(array $response)
	{
		$this->data = [];

		foreach ($response as $block)
			$this->data[] = new OrgUnitType($block);
	}

	public function next(): ?OrgUnitType
	{
		return $this->data[$this->pointer++] ?? null;
	}
}
