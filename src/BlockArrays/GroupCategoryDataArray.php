<?php

namespace BrightspaceDevHelper\Valence\BlockArray;

use BrightspaceDevHelper\Valence\Block\GroupCategoryData;
use BrightspaceDevHelper\Valence\Structure\BlockArray;

class GroupCategoryDataArray extends BlockArray
{
	public function __construct(array $response)
	{
		$this->data = [];

		foreach ($response as $block)
			$this->data[] = new GroupCategoryData($block);
	}

	public function next(): ?GroupCategoryDataArray
	{
		return $this->data[$this->pointer++] ?? null;
	}
}
