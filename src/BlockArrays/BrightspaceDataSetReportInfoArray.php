<?php

namespace BrightspaceDevHelper\Valence\BlockArray;

use BrightspaceDevHelper\Valence\Block\BrightspaceDataSetReportInfo;
use BrightspaceDevHelper\Valence\Structure\BlockArray;

class BrightspaceDataSetReportInfoArray extends BlockArray
{
	public string $blockClass = BrightspaceDataSetReportInfo::class;

	public function build(array $response): void
	{
		$this->nextPageRoute = $response['NextPageUrl'] ? substr($response['NextPageUrl'], strpos($response['NextPageUrl'], '/d2l/api/')) : null;

		parent::build($response['BrightspaceDataSets']);
	}

	public function current(): ?BrightspaceDataSetReportInfo
	{
		return parent::current();
	}
}
