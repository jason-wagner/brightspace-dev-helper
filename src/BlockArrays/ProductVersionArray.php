<?php

namespace BrightspaceDevHelper\Valence\BlockArray;

use BrightspaceDevHelper\Valence\Block\ProductVersions;
use BrightspaceDevHelper\Valence\Structure\BlockArray;

class ProductVersionArray extends BlockArray
{
	public string $blockClass = ProductVersions::class;

	public function current(): ?ProductVersions
	{
		return parent::current();
	}
}
