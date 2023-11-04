<?php

namespace BrightspaceDevHelper\Valence\Block;

use BrightspaceDevHelper\Valence\Attributes\AVAILABILITY;
use BrightspaceDevHelper\Valence\Attributes\RATING;
use BrightspaceDevHelper\Valence\Attributes\SCORING;
use BrightspaceDevHelper\Valence\Client\Valence;
use BrightspaceDevHelper\Valence\Structure\Block;

class UserAccommodations extends Block
{
	public int $OrgUnitId;
	public int $UserId;
	public QuizzingAccommodations $QuizzingAccommodations;

	public function __construct(array $response)
	{
		parent::__construct($response, ['QuizzingAccommodations']);

		$this->QuizzingAccommodations = new QuizzingAccommodations($response['QuizzingAccommodations']);
	}
}
