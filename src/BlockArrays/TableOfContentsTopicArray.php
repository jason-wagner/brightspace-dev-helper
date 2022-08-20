<?php

namespace BrightspaceDevHelper\Valence\BlockArray;

use BrightspaceDevHelper\Valence\Block\TableOfContentsTopic;
use BrightspaceDevHelper\Valence\Structure\BlockArray;

class TableOfContentsTopicArray extends BlockArray
{
	public string $blockClass = TableOfContentsTopic::class;

	public function current(): ?TableOfContentsTopic
	{
		return parent::current();
	}
}
