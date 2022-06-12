<?php

namespace BrightspaceDevHelper\Valence\BlockArray;

use BrightspaceDevHelper\Valence\Block\GroupData;
use BrightspaceDevHelper\Valence\Structure\Block;
use BrightspaceDevHelper\Valence\Structure\BlockArray;

class GroupDataArray extends BlockArray
{
	public string $blockClass = GroupData::class;

	public function current(): ?GroupData
	{
		return parent::current();
	}
}
