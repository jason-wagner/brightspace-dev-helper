<?php

namespace BrightspaceDevHelper\Valence\CreateBlock;

use BrightspaceDevHelper\Valence\Array\COPYCOMPONENT;
use BrightspaceDevHelper\Valence\Client\Valence;
use BrightspaceDevHelper\Valence\Client\ValenceCourse;
use BrightspaceDevHelper\Valence\Structure\CreateBlock;
use BrightspaceDevHelper\Valence\Block\CourseOffering;

class CreateCopyJobRequest extends CreateBlock
{
	public function __construct(Valence                         $valence,
								public int                      $SourceOrgUnitId,
								public COPYCOMPONENT|array|null $Components,
								public ?string                  $CallbackUrl,
								public ?int                     $DaysToOffsetDates,
								public ?float                   $HoursToOffsetDates,
								public ?bool                    $OffsetByStartDateDifference)
	{
		$this->valence = $valence;

		if (!is_array($this->Components))
			$this->Components = $this->Components->toArray();
	}

	public function toArray(): array
	{
		$a = parent::toArray();

		if ($this->DaysToOffsetDates || $this->HoursToOffsetDates)
			unset($a['OffsetByStartDateDifference']);
		else
			unset($a['DaysToOffsetDates'], $a['HoursToOffsetDates']);

		return $a;
	}

	public function create(int $orgUnitId): ValenceCourse|CourseOffering
	{
		return $this->valence->createCourseCopyRequest($orgUnitId, $this);
	}
}
