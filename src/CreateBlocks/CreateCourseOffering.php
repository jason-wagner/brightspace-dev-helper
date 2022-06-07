<?php

namespace BrightspaceDevHelper\Valence\CreateBlock;

use BrightspaceDevHelper\Valence\Client\Valence;
use BrightspaceDevHelper\Valence\Client\ValenceCourse;
use BrightspaceDevHelper\Valence\Structure\CreateBlock;
use BrightspaceDevHelper\Valence\Block\CourseOffering;

class CreateCourseOffering extends CreateBlock
{
	public function __construct(Valence              $valence,
								public string        $Name,
								public string        $Code,
								public ?string       $Path,
								public int           $CourseTemplateId,
								public ?int          $SemesterId,
								public ?string       $StartDate,
								public ?string       $EndDate,
								public ?int          $LocaleId,
								public bool          $ForceLocale,
								public bool          $ShowAddressBook,
								public RichTextInput $Description,
								public ?bool         $CanSelfRegister)
	{
		$this->valence = $valence;
	}

	public function create(): ValenceCourse|CourseOffering
	{
		return $this->valence->createCourseOffering($this);
	}
}
