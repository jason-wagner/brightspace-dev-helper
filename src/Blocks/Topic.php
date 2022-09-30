<?php

namespace BrightspaceDevHelper\Valence\Block;

use BrightspaceDevHelper\Valence\Attributes\AVAILABILITY;
use BrightspaceDevHelper\Valence\Attributes\RATING;
use BrightspaceDevHelper\Valence\Attributes\SCORING;
use BrightspaceDevHelper\Valence\Client\Valence;
use BrightspaceDevHelper\Valence\Structure\Block;

class Topic extends Block
{
	public int $ForumId;
	public int $TopicId;
	public string $Name;
	public RichText $Description;
	public ?string $StartDate;
	public ?string $EndDate;
	public ?string $UnlockStartDate;
	public ?string $UnlockEndDate;
	public bool $IsLocked;
	public bool $AllowAnonymousPosts;
	public bool $RequiresApproval;
	public int $UnapprovedPostCount;
	public int $PinnedPostCount;
	public SCORING $ScoringType;
	public bool $IsAutoScore;
	public ?int $ScoreOutOf;
	public bool $IncludeNonScoredValues;
	public int $ScoredCount;
	public int $RatingsSum;
	public int $RatingsCount;
	public bool $IsHidden;
	public bool $MustPostToParticipate;
	public RATING $RatingType;
	public ?int $ActivityId;
	public ?int $GroupTypeId;
	public ?AVAILABILITY $StartDateAvailabilityType;
	public ?AVAILABILITY $EndDateAvailabilityType;

	public function __construct(array $response, Valence $valence)
	{
		parent::__construct($response, ['Description', 'ScoringType', 'RatingType', 'StartDate', 'EndDate', 'UnlockStartDate', 'UnlockEndDate', 'StartDateAvailabilityType', 'EndDateAvailabilityType']);

		$this->Description = new RichText($response['Description']);

		foreach (['StartDate', 'EndDate', 'UnlockStartDate', 'UnlockEndDate'] as $key)
			$this->$key = $response[$key] != '' ? $valence->createDateTimeFromIso8601($response[$key], $valence)->getTimestamp() : null;

		$this->ScoringType = SCORING::tryFrom($response['ScoringType']);
		$this->RatingType = RATING::tryFrom($response['RatingType']);
		$this->StartDateAvailabilityType = AVAILABILITY::tryFrom($response['StartDateAvailabilityType']);
		$this->EndDateAvailabilityType = AVAILABILITY::tryFrom($response['EndDateAvailabilityType']);
	}
}
