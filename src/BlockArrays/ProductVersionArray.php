<?php

namespace BrightspaceDevHelper\Valence\BlockArray;

use BrightspaceDevHelper\Valence\Block\ProductVersions;
use BrightspaceDevHelper\Valence\Structure\BlockArray;

class ProductVersionArray extends BlockArray
{
	public function __construct(array $response)
	{
		$this->data = [];

		foreach ($response as $block)
			$this->data[] = new ProductVersions($block);
	}

	public function next(): ?ProductVersions
	{
		return parent::next();
	}
}
