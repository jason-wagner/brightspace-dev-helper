<?php

namespace BrightspaceDevHelper\Valence\Block;

use BrightspaceDevHelper\Valence\Attributes\AVAILABILITY;
use BrightspaceDevHelper\Valence\Attributes\RATING;
use BrightspaceDevHelper\Valence\Attributes\SCORING;
use BrightspaceDevHelper\Valence\Structure\Block;

class Topic extends Block
{
	public $ForumId;
	public $TopicId;
	public $Name;
	public $Description;
	public $StartDate;
	public $EndDate;
	public $UnlockStartDate;
	public $UnlockEndDate;
	public $IsLocked;
	public $AllowAnonymousPosts;
	public $RequiresApproval;
	public $UnapprovedPostCount;
	public $PinnedPostCount;
	public $ScoringType;
	public $IsAutoScore;
	public $ScoreOutOf;
	public $IncludeNonScoredValues;
	public $ScoredCount;
	public $RatingsSum;
	public $RatingsCount;
	public $IsHidden;
	public $MustPostToParticipate;
	public $RatingType;
	public $ActivityId;
	public $GroupTypeId;
	public $StartDateAvailabilityType;
	public $EndDateAvailabilityType;

	public function __construct(array $response)
	{
		parent::__construct($response, ['Description', 'ScoringType', 'RatingType', 'StartDateAvailabilityType', 'EndDateAvailabilityType']);
		$this->Description = new RichText($response['Description']);
		$this->ScoringType = SCORING::tryFrom($response['ScoringType']);
		$this->RatingType = RATING::tryFrom($response['RatingType']);
		$this->StartDateAvailabilityType = AVAILABILITY::tryFrom($response['StartDateAvailabilityType']);
		$this->EndDateAvailabilityType = AVAILABILITY::tryFrom($response['EndDateAvailabilityType']);
	}
}
