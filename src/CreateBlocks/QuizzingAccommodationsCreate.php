<?php

namespace BrightspaceDevHelper\Valence\CreateBlock;

use BrightspaceDevHelper\Valence\Structure\CreateBlock;

class QuizzingAccommodationsCreate extends CreateBlock
{
	public function __construct(public QuizzingControlAccommodationCreate   $QuizzingControlAccommodation,
								public QuizzingTimeLimitAccommodationCreate $QuizzingTimeLimitAccommodation)
	{

	}
}
