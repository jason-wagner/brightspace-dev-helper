<?php

namespace BrightspaceDevHelper\Valence\BlockArray;

use BrightspaceDevHelper\Valence\Block\Topic;
use BrightspaceDevHelper\Valence\Structure\BlockArray;

class TopicArray extends BlockArray
{
	public function __construct(array $response)
	{
		$this->data = [];

		foreach ($response as $block)
			$this->data[] = new Topic($block);
	}

	public function next(): ?Topic
	{
		return $this->data[$this->pointer++] ?? null;
	}
}
