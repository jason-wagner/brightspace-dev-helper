<?php

namespace BrightspaceDevHelper\Valence\BlockArray;

use BrightspaceDevHelper\Valence\Block\Post;
use BrightspaceDevHelper\Valence\Structure\BlockArray;

class PostArray extends BlockArray
{
	public string $blockClass = Post::class;

	public function current(): ?Post
	{
		return parent::current();
	}
}
