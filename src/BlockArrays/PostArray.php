<?php

namespace BrightspaceDevHelper\Valence\BlockArray;

use BrightspaceDevHelper\Valence\Block\Post;
use BrightspaceDevHelper\Valence\Structure\BlockArray;

class PostArray extends BlockArray
{
	public $blockClass = Post::class;

	public function next(): ?Post
	{
		return parent::next();
	}
}
