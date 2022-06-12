<?php

namespace BrightspaceDevHelper\Valence\BlockArray;

use BrightspaceDevHelper\Valence\Block\Topic;
use BrightspaceDevHelper\Valence\Structure\BlockArray;

class TopicArray extends BlockArray
{
	public string $blockClass = Topic::class;

	public function current(): ?Topic
	{
		return parent::current();
	}
}
