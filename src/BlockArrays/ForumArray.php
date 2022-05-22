<?php

namespace BrightspaceDevHelper\Valence\BlockArray;

use BrightspaceDevHelper\Valence\Block\Forum;
use BrightspaceDevHelper\Valence\Structure\BlockArray;

class ForumArray extends BlockArray
{
	public string $blockClass = Forum::class;

	public function next(): ?Forum
	{
		return parent::next();
	}
}
