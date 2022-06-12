<?php

namespace BrightspaceDevHelper\Valence\BlockArray;

use BrightspaceDevHelper\Valence\Block\GroupCategoryData;
use BrightspaceDevHelper\Valence\Structure\Block;
use BrightspaceDevHelper\Valence\Structure\BlockArray;

class GroupCategoryDataArray extends BlockArray
{
	public string $blockClass = GroupCategoryData::class;

	public function current(): ?GroupCategoryData
	{
		return parent::current();
	}
}
