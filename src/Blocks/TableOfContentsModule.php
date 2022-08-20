<?php

namespace BrightspaceDevHelper\Valence\Block;

use BrightspaceDevHelper\Valence\BlockArray\TableOfContentsModuleArray;
use BrightspaceDevHelper\Valence\BlockArray\TableOfContentsTopicArray;
use BrightspaceDevHelper\Valence\Client\Valence;
use BrightspaceDevHelper\Valence\Structure\Block;

class TableOfContentsModule extends Block
{
	public int $ModuleId;
	public string $Title;
	public int $SortOrder;
	public ?string $StartDateTime;
	public ?string $EndDateTime;
	public TableOfContentsModuleArray $Modules;
	public TableOfContentsTopicArray $Topics;
	public bool $IsHidden;
	public bool $IsLocked;
	public ?string $PacingStartDate;
	public ?string $PacingEndDate;
	public string $DefaultPath;
	public ?string $LastModifiedDate;

	public function __construct(array $response, Valence $valence)
	{
		parent::__construct($response, ['StartDateTime', 'EndDateTime', 'Modules', 'Topics', 'PacingStartDate', 'PacingEndDate', 'LastModifiedDate']);

		foreach (['StartDateTime', 'EndDateTime', 'PacingStartDate', 'PacingEndDate', 'LastModifiedDate'] as $key)
			$this->$key = $response[$key] != '' ? $valence->createDateTimeFromIso8601($response[$key])->getTimestamp() : null;

		$this->Modules = new TableOfContentsModuleArray($response['Modules'], $valence);
		$this->Topics = new TableOfContentsTopicArray($response['Topics'], $valence);
	}
}
