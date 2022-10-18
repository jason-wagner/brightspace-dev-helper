<?php

namespace BrightspaceDevHelper\Valence\CreateBlock;

use BrightspaceDevHelper\Valence\Block\EnrollmentData;
use BrightspaceDevHelper\Valence\Client\Valence;
use BrightspaceDevHelper\Valence\Structure\CreateBlock;

class CreateEnrollmentData extends CreateBlock
{
	public function __construct(Valence    $valence,
								public int $OrgUnitId,
								public int $UserId,
								public int $RoleId)
	{
		$this->valence = $valence;
	}

	public function create(): ?EnrollmentData
	{
		return $this->valence->enrollUser($this);
	}
}
