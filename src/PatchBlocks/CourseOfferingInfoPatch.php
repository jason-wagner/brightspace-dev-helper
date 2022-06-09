<?php

namespace BrightspaceDevHelper\Valence\PatchBlock;

use BrightspaceDevHelper\Valence\Client\Valence;
use BrightspaceDevHelper\Valence\CreateBlock\RichTextInput;
use BrightspaceDevHelper\Valence\Object\DateTime;
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

			$this->$k = $k == 'Description' ? $data->$k->toInput() : $data->$k;
		}
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

	public function setStartDate(DateTime|string|null $StartDate): void
	{
		$this->StartDate = $StartDate instanceof DateTime ? $StartDate->getIso8601() : $StartDate;
	}

	public function setEndDate(DateTime|string|null $EndDate): void
	{
		$this->EndDate = $EndDate instanceof DateTime ? $EndDate->getIso8601() : $EndDate;
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
