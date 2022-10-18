<?php

namespace BrightspaceDevHelper\Valence\CreateBlock;

use BrightspaceDevHelper\Valence\Client\Valence;
use BrightspaceDevHelper\Valence\Structure\CreateBlock;

class GroupEnrollment extends CreateBlock
{
	protected array $nonprops = ['orgUnitId', 'groupCategoryId', 'groupId'];

	public function __construct(Valence    $valence,
								public int $orgUnitId,
								public int $groupCategoryId,
								public int $groupId,
								public int $UserId)
	{
		$this->valence = $valence;
	}

	public function create(): array
	{
		return $this->valence->enrollUserInGroup($this->orgUnitId, $this->groupCategoryId, $this->groupId, $this);
	}
}
