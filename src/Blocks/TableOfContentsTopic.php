<?php

namespace BrightspaceDevHelper\Valence\Block;

use BrightspaceDevHelper\Valence\Attributes\ACTIVITYTYPE;
use BrightspaceDevHelper\Valence\Attributes\CONTENT_COMPLETIONTYPE;
use BrightspaceDevHelper\Valence\Client\Valence;
use BrightspaceDevHelper\Valence\Structure\Block;

class TableOfContentsTopic extends Block
{
	public int $TopicId;
	public int $Identifier;
	public string $TypeIdentifier;
	public string $Title;
	public bool $Bookmarked;
	public bool $Unread;
	public string $Url;
	public int $SortOrder;
	public ?string $StartDateTime;
	public ?string $EndDateTime;
	public ?string $ActivityId;
	public CONTENT_COMPLETIONTYPE $CompletionType;
	public bool $IsExempt;
	public bool $IsHidden;
	public bool $IsLocked;
	public bool $IsBroken;
	public ?int $ToolId;
	public ?int $ToolItemId;
	public ACTIVITYTYPE $ActivityType;
	public ?int $GradeItemId;
	public ?string $LastModifiedDate;
	public RichText $Description;

	public function __construct(array $response, Valence $valence)
	{
		parent::__construct($response, ['StartDateTime, EndDateTime', 'CompletionType', 'ActivityType', 'LastModifiedDate', 'Description']);

		foreach (['StartDateTime', 'EndDateTime', 'LastModifiedDate'] as $key)
			$this->$key = $response[$key] != '' ? $valence->createDateTimeFromIso8601($response[$key])->getTimestamp() : null;

		$this->CompletionType = CONTENT_COMPLETIONTYPE::tryFrom($response['CompletionType']);
		$this->ActivityType = ACTIVITYTYPE::tryFrom($response['ActivityType']);
		$this->Description = new RichText($response['Description']);
	}
}
