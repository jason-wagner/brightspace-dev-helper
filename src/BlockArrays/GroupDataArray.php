<?php

namespace BrightspaceDevHelper\Valence\BlockArray;

use BrightspaceDevHelper\Valence\Block\GroupData;
use BrightspaceDevHelper\Valence\Structure\BlockArray;

class GroupDataArray extends BlockArray
{
	public function __construct(array $response)
	{
		$this->data = [];

		foreach ($response as $block)
			$this->data[] = new GroupData($block);
	}

	public function next(): ?GroupData
	{
		return parent::next();
	}
}
