<?php

namespace BrightspaceDevHelper\Valence\BlockArray;

use BrightspaceDevHelper\Valence\Block\Forum;
use BrightspaceDevHelper\Valence\Structure\BlockArray;

class ForumArray extends BlockArray
{
	public function __construct(array $response)
	{
		$this->data = [];

		foreach ($response as $block)
			$this->data[] = new Forum($block);
	}

	public function next(): ?Forum
	{
		return $this->data[$this->pointer++] ?? null;
	}
}
