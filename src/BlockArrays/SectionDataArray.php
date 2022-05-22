<?php

namespace BrightspaceDevHelper\Valence\BlockArray;

use BrightspaceDevHelper\Valence\Block\SectionData;
use BrightspaceDevHelper\Valence\Structure\BlockArray;

class SectionDataArray extends BlockArray
{
	public string $blockClass = SectionData::class;

	public function next(): ?SectionData
	{
		return parent::next();
	}
}
