<?php

namespace BrightspaceDevHelper\Valence\BlockArray;

use BrightspaceDevHelper\Valence\Block\NewsItem;
use BrightspaceDevHelper\Valence\Structure\BlockArray;

class NewsItemArray extends BlockArray
{
	public string $blockClass = NewsItem::class;

	public function current(): ?NewsItem
	{
		return parent::current();
	}
}
