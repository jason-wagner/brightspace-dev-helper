<?php

namespace BrightspaceDevHelper\Valence\BlockArray;

use BrightspaceDevHelper\Valence\Block\BrightspaceDataSetReportInfo;
use BrightspaceDevHelper\Valence\Structure\BlockArray;

class BrightspaceDataSetReportInfoPreviousArray extends BlockArray
{
	public string $blockClass = BrightspaceDataSetReportInfo::class;

	public function current(): ?BrightspaceDataSetReportInfo
	{
		return parent::current();
	}
}
