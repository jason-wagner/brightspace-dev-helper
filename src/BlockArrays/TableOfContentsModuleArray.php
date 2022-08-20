<?php

namespace BrightspaceDevHelper\Valence\BlockArray;

use BrightspaceDevHelper\Valence\Block\TableOfContentsModule;
use BrightspaceDevHelper\Valence\Structure\BlockArray;

class TableOfContentsModuleArray extends BlockArray
{
	public string $blockClass = TableOfContentsModule::class;

	public function current(): ?TableOfContentsModule
	{
		return parent::current();
	}
}
