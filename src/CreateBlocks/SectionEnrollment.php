<?php

namespace BrightspaceDevHelper\Valence\CreateBlock;

use BrightspaceDevHelper\Valence\Client\Valence;
use BrightspaceDevHelper\Valence\Structure\CreateBlock;

class SectionEnrollment extends CreateBlock
{
	protected array $nonprops = ['orgUnitId', 'sectionId'];

	public function __construct(Valence    $valence,
								public int $orgUnitId,
								public int $sectionId,
								public int $UserId)
	{
		$this->valence = $valence;
	}

	public function create(): array
	{
		return $this->valence->enrollUserInCourseSection($this->orgUnitId, $this->sectionId, $this);
	}
}
