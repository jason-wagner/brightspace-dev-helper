<?php

namespace BrightspaceDevHelper\Valence\BlockArray;

use BrightspaceDevHelper\Valence\Block\GroupData;
use BrightspaceDevHelper\Valence\Structure\BlockArray;

class GroupDataArray extends BlockArray
{
	public $blockClass = GroupData::class;

	public function next(): ?GroupData
	{
		return parent::next();
	}
}
