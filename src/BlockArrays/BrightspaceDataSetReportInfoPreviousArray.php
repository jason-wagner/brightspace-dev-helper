<?php

namespace BrightspaceDevHelper\Valence\BlockArray;

use BrightspaceDevHelper\Valence\Block\BrightspaceDatasetReportInfo;
use BrightspaceDevHelper\Valence\Structure\BlockArray;

class BrightspaceDataSetReportInfoPreviousArray extends BlockArray
{
	public string $blockClass = BrightspaceDatasetReportInfo::class;

	public function current(): ?BrightspaceDatasetReportInfo
	{
		return parent::current();
	}
}
