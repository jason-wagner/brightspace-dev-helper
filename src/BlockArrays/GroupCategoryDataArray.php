<?php

namespace BrightspaceDevHelper\Valence\BlockArray;

use BrightspaceDevHelper\Valence\Block\GroupCategoryData;
use BrightspaceDevHelper\Valence\Structure\BlockArray;

class GroupCategoryDataArray extends BlockArray
{
	public $blockClass = GroupCategoryData::class;

	public function next(): ?GroupCategoryDataArray
	{
		return parent::next();
	}
}
