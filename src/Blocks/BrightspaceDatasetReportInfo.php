<?php

namespace BrightspaceDevHelper\Valence\Block;

use BrightspaceDevHelper\Valence\BlockArray\BrightspaceDataSetReportInfoPreviousArray;
use BrightspaceDevHelper\Valence\Structure\Block;

class BrightspaceDatasetReportInfo extends Block
{
	public $PluginId;
	public $Name;
	public $Description;
	public $FulLDataSet;
	public $CreatedDate;
	public $DownloadLink;
	public $DownloadSize;
	public $Version;
	public $PreviousDataSets;
	public $QueuedForProcessingDate;
	public $CurrentlyAvailable;

	public function __construct(array $response)
	{
		parent::__construct($response, ['PreviousDataSets']);
		$this->PreviousDataSets = is_array($response['PreviousDataSets']) ? new BrightspaceDataSetReportInfoPreviousArray($response['PreviousDataSets']) : null;
	}
}
