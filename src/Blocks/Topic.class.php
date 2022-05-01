<?php

namespace BrightspaceDevHelper\Valence\Block;

use BrightspaceDevHelper\Valence\Block;

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
		parent::__construct($response, ['Description']);
		$this->Description = new RichText($response['Description']);
	}
}
