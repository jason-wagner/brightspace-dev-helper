<?php

namespace BrightspaceDevHelper\Valence\Block;

use BrightspaceDevHelper\Valence\BlockArray\BrightspaceDataSetReportInfoPreviousArray;
use BrightspaceDevHelper\Valence\Structure\Block;

class BrightspaceDataSetReportInfo extends Block
{
	public string $PluginId;
	public string $Name;
	public string $Description;
	public bool $FulLDataSet;
	public ?string $CreatedDate;
	public ?string $DownloadLink;
	public ?int $DownloadSize;
	public ?string $Version;
	public ?BrightspaceDataSetReportInfoPreviousArray $PreviousDataSets;
	public ?string $QueuedForProcessingDate;
	public bool $CurrentlyAvailable;

	public function __construct(array $response)
	{
		parent::__construct($response, ['PreviousDataSets']);
		$this->PreviousDataSets = is_array($response['PreviousDataSets']) ? new BrightspaceDataSetReportInfoPreviousArray($response['PreviousDataSets']) : null;
	}
}
