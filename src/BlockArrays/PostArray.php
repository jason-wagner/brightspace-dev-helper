<?php

namespace BrightspaceDevHelper\Valence\BlockArray;

use BrightspaceDevHelper\Valence\Block\Post;
use BrightspaceDevHelper\Valence\Structure\BlockArray;

class PostArray extends BlockArray
{
	public function __construct(array $response)
	{
		$this->data = [];

		foreach ($response as $block)
			$this->data[] = new Post($block);
	}

	public function next(): ?Post
	{
		return parent::next();
	}
}
