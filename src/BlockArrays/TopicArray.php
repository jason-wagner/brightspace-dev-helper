<?php

namespace BrightspaceDevHelper\Valence\BlockArray;

use BrightspaceDevHelper\Valence\Block\Topic;
use BrightspaceDevHelper\Valence\Structure\BlockArray;

class TopicArray extends BlockArray
{
	public $blockClass = Topic::class;

	public function next(): ?Topic
	{
		return parent::next();
	}
}
