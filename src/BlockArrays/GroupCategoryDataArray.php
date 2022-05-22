<?php

namespace BrightspaceDevHelper\Valence\BlockArray;

use BrightspaceDevHelper\Valence\Block\GroupCategoryData;
use BrightspaceDevHelper\Valence\Structure\Block;
use BrightspaceDevHelper\Valence\Structure\BlockArray;

class GroupCategoryDataArray extends BlockArray
{
	public string $blockClass = GroupCategoryData::class;

	public function next(): ?GroupCategoryData
	{
		return parent::next();
	}
}
