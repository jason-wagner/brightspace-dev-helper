<?php

namespace BrightspaceDevHelper\Valence\PatchBlock;

use BrightspaceDevHelper\Valence\Client\Valence;
use BrightspaceDevHelper\Valence\CreateBlock\RichTextInput;
use BrightspaceDevHelper\Valence\UpdateBlock\CourseOfferingInfo;

class CourseOfferingInfoPatch extends CourseOfferingInfo
{
	protected array $nonprops = ['orgUnitId'];

	public function __construct(Valence $valence, int $orgUnitId)
	{
		$this->valence = $valence;
		$this->orgUnitId = $orgUnitId;

		$data = $this->valence->getCourseOffering($this->orgUnitId);

		foreach ($this as $k => $v) {
			if (in_array($k, ['valence', 'nonprops']) || in_array($k, $this->nonprops))
				continue;

			if ($k == 'Description')
				$this->$k = $data->$k->toInput();
			else
				$this->$k = $data->$k;
		}

		$this->Name = $data->Name;
		$this->Code = $data->Code;
		$this->IsActive = $data->IsActive;
		$this->StartDate = $data->StartDate;
		$this->EndDate = $data->EndDate;
		$this->Description = $data->Description->toInput();
		$this->CanSelfRegister = $data->CanSelfRegister;
	}

	public function setName(string $Name): void
	{
		$this->Name = $Name;
	}

	public function setCode(string $Code): void
	{
		$this->Code = $Code;
	}

	public function setIsActive(bool $IsActive): void
	{
		$this->IsActive = $IsActive;
	}

	public function setStartDate(?string $StartDate): void
	{
		$this->StartDate = $StartDate;
	}

	public function setEndDate(?string $EndDate): void
	{
		$this->EndDate = $EndDate;
	}

	public function setDescription(RichTextInput $Description): void
	{
		$this->Description = $Description;
	}

	public function setCanSelfRegister(bool $CanSelfRegister)
	{
		$this->CanSelfRegister = $CanSelfRegister;
	}
}
