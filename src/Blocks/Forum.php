<?php

namespace BrightspaceDevHelper\Valence\Block;

use BrightspaceDevHelper\Valence\Attributes\AVAILABILITY;
use BrightspaceDevHelper\Valence\Structure\Block;

class Forum extends Block
{
	public int $ForumId;
	public ?string $StartDate;
	public ?string $EndDate;
	public ?string $PostStartDate;
	public ?string $PostEndDate;
	public string $Name;
	public RichText $Description;
	public ?bool $ShowDescriptionInTopics;
	public bool $AllowAnonymous;
	public bool $IsLocked;
	public bool $IsHidden;
	public bool $RequiresApproval;
	public bool $DisplayInCalendar;
	public ?AVAILABILITY $StartDateAvailabilityType;
	public ?AVAILABILITY $EndDateAvailabilityType;

	public function __construct(array $response)
	{
		parent::__construct($response, ['StartDate', 'EndDate', 'PostStartDate', 'PostEndDate', 'Description', 'StartDateAvailabilityType', 'EndDateAvailabilityType']);

		foreach (['StartDate', 'EndDate', 'PostStartDate', 'PostEndDate'] as $key)
			$this->$key = $response[$key] != '' ? $valence->createDateTimeFromIso8601($response[$key], $valence)->getTimestamp() : null;

		$this->Description = new RichText($response['Description']);
		$this->StartDateAvailabilityType = AVAILABILITY::tryFrom($response['StartDateAvailabilityType']);
		$this->EndDateAvailabilityType = AVAILABILITY::tryFrom($response['EndDateAvailabilityType']);
	}
}
