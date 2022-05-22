<?php

namespace BrightspaceDevHelper\Valence\BlockArray;

use BrightspaceDevHelper\Valence\Block\BrightspaceDatasetReportInfo;
use BrightspaceDevHelper\Valence\Structure\BlockArray;

class BrightspaceDataSetReportInfoPreviousArray extends BlockArray
{
	public string $blockClass = BrightspaceDatasetReportInfo::class;

	public function build(?array $response): void
	{
		parent::build($response);
	}

	public function next(): ?BrightspaceDatasetReportInfo
	{
		return parent::next();
	}
}
