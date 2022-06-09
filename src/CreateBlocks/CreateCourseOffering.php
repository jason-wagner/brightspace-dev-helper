<?php

namespace BrightspaceDevHelper\Valence\CreateBlock;

use BrightspaceDevHelper\Valence\Client\Valence;
use BrightspaceDevHelper\Valence\Client\ValenceCourse;
use BrightspaceDevHelper\Valence\Object\DateTime;
use BrightspaceDevHelper\Valence\Structure\CreateBlock;
use BrightspaceDevHelper\Valence\Block\CourseOffering;

class CreateCourseOffering extends CreateBlock
{
	public function __construct(Valence                     $valence,
								public string               $Name,
								public string               $Code,
								public ?string              $Path,
								public int                  $CourseTemplateId,
								public ?int                 $SemesterId,
								public DateTime|string|null $StartDate,
								public DateTime|string|null $EndDate,
								public ?int                 $LocaleId,
								public bool                 $ForceLocale,
								public bool                 $ShowAddressBook,
								public RichTextInput        $Description,
								public ?bool                $CanSelfRegister)
	{
		$this->valence = $valence;

		if($this->StartDate instanceof DateTime)
			$this->StartDate = $this->StartDate->getIso8601();

		if($this->EndDate instanceof DateTime)
			$this->EndDate = $this->EndDate->getIso8601();
	}

	public function create(): ValenceCourse|CourseOffering
	{
		return $this->valence->createCourseOffering($this);
	}
}
