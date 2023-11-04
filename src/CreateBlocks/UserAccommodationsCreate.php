<?php

namespace BrightspaceDevHelper\Valence\CreateBlock;

use BrightspaceDevHelper\Valence\Block\UserAccommodations;
use BrightspaceDevHelper\Valence\Client\Valence;
use BrightspaceDevHelper\Valence\Structure\CreateBlock;

class UserAccommodationsCreate extends CreateBlock
{
	public function __construct(Valence                             $valence,
								public int                          $OrgUnitId,
								public int                          $UserId,
								public QuizzingAccommodationsCreate $QuizzingAccommodations)
	{
		$this->valence = $valence;
	}

	public function create(): UserAccommodations
	{
		return $this->valence->setAccommodations($this);
	}
}
