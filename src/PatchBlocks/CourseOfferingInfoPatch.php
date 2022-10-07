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

		foreach (['Name', 'Code', 'IsActive', 'StartDate', 'EndDate', 'CanSelfRegister'] as $k) {
			if (in_array($k, ['valence', 'nonprops']) || in_array($k, $this->nonprops))
				continue;

			$this->$k = $data->$k;
		}

		$this->Description = $data->Description->toInput();
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

	public function update(): void
	{
		if (!is_null($this->StartDate) && strlen($this->StartDate) == 19)
			$this->StartDate = DateTime::createFromTimestamp($this->StartDate, $this->valence)->getIso8601();

		if (!is_null($this->EndDate) && strlen($this->EndDate) == 19)
			$this->EndDate = DateTime::createFromTimestamp($this->EndDate, $this->valence)->getIso8601();

		$this->valence->updateCourseOffering($this->orgUnitId, $this);
	}
}
