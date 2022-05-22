<?php

namespace BrightspaceDevHelper\Valence\Block;

use BrightspaceDevHelper\Valence\Attributes\AVAILABILITY;
use BrightspaceDevHelper\Valence\Structure\Block;

class Forum extends Block
{
	public $ForumId;
	public $StartDate;
	public $EndDate;
	public $PostStartDate;
	public $PostEndDate;
	public $Name;
	public $Description;
	public $ShowDescriptionInTopics;
	public $AllowAnonymous;
	public $IsLocked;
	public $IsHidden;
	public $RequiresApproval;
	public $DisplayInCalendar;
	public $StartDateAvailabilityType;
	public $EndDateAvailabilityType;

	public function __construct(array $response)
	{
		parent::__construct($response, ['Description', 'StartDateAvailabilityType', 'EndDateAvailabilityType']);
		$this->Description = new RichText($response['Description']);
		$this->StartDateAvailabilityType = AVAILABILITY::tryFrom($response['StartDateAvailabilityType']);
		$this->EndDateAvailabilityType = AVAILABILITY::tryFrom($response['EndDateAvailabilityType']);
	}
}
