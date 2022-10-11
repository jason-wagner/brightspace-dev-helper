<?php

namespace BrightspaceDevHelper\Valence\UpdateBlock;

use BrightspaceDevHelper\Valence\Client\Valence;
use BrightspaceDevHelper\Valence\CreateBlock\RichTextInput;
use BrightspaceDevHelper\Valence\Object\DateTime;
use BrightspaceDevHelper\Valence\Structure\UpdateBlock;

class CourseOfferingInfo extends UpdateBlock
{
	protected array $nonprops = ['orgUnitId'];

	public function __construct(Valence                     $valence,
								public int                  $orgUnitId,
								public string               $Name,
								public string               $Code,
								public bool                 $IsActive,
								public DateTime|string|null $StartDate,
								public DateTime|string|null $EndDate,
								public RichTextInput        $Description,
								public bool                 $CanSelfRegister)
	{
		$this->valence = $valence;

		if ($this->StartDate instanceof DateTime)
			$this->StartDate = $this->StartDate->getIso8601();

		if ($this->EndDate instanceof DateTime)
			$this->EndDate = $this->EndDate->getIso8601();
	}
}
