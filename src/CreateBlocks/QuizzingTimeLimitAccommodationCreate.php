<?php

namespace BrightspaceDevHelper\Valence\CreateBlock;

use BrightspaceDevHelper\Valence\Attributes\TIMEOP;
use BrightspaceDevHelper\Valence\Structure\CreateBlock;

class QuizzingTimeLimitAccommodationCreate extends CreateBlock
{
	public function __construct(public TIMEOP $TimeLimitOperation,
								public float  $TimeMultiplier,
								public int    $AdditionalTime)
	{

	}
}
