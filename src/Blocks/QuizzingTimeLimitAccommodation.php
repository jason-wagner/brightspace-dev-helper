<?php

namespace BrightspaceDevHelper\Valence\Block;

use BrightspaceDevHelper\Valence\Attributes\TIMEOP;
use BrightspaceDevHelper\Valence\Structure\Block;

class QuizzingTimeLimitAccommodation extends Block
{
	public TIMEOP $TimeLimitOperation;
	public float $TimeMultiplier;
	public int $AdditionalTime;

	public function __construct(array $response)
	{
		parent::__construct($response, ['TimeLimitOperation']);

		$this->TimeLimitOperation = TIMEOP::tryFrom($response['TimeLimitOperation']);
	}
}
