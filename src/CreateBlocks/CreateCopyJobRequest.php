<?php

namespace BrightspaceDevHelper\Valence\CreateBlock;

use BrightspaceDevHelper\Valence\Array\COPYCOMPONENT;
use BrightspaceDevHelper\Valence\Block\CreateCopyJobResponse;
use BrightspaceDevHelper\Valence\Client\Valence;
use BrightspaceDevHelper\Valence\Structure\CreateBlock;

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
		$data = parent::toArray();

		if ($this->DaysToOffsetDates || $this->HoursToOffsetDates)
			unset($data['OffsetByStartDateDifference']);
		else
			unset($data['DaysToOffsetDates'], $data['HoursToOffsetDates']);

		return $data;
	}

	public function create(int $orgUnitId): ?CreateCopyJobResponse
	{
		return $this->valence->createCourseCopyRequest($orgUnitId, $this);
	}
}
