<?php

namespace BrightspaceDevHelper\Valence\PatchBlock;

use BrightspaceDevHelper\Valence\Block\RichText;
use BrightspaceDevHelper\Valence\Client\Valence;
use BrightspaceDevHelper\Valence\CreateBlock\NewsItemData;
use BrightspaceDevHelper\Valence\Object\DateTime;

class NewsItemDataPatch extends NewsItemData
{
	protected array $nonprops = ['orgUnitId', 'newsItemId'];

	public int $newsItemId;

	public function __construct(Valence $valence, int $orgUnitId, int $newsItemId)
	{
		$this->valence = $valence;
		$this->orgUnitId = $orgUnitId;
		$this->newsItemId = $newsItemId;

		$data = $this->valence->getCourseAnnouncement($this->orgUnitId, $this->newsItemId);

		foreach (['Title', 'Body', 'StartDate', 'EndDate', 'IsGlobal', 'IsPublished', 'ShowOnlyInCourseOfferings', 'IsAuthorInfoShown'] as $key) {
			$this->$key = $data->$key;
		}
	}

	public function setTitle(string $Title): void
	{
		$this->Title = $Title;
	}

	public function setBody(RichText $Body): void
	{
		$this->Body = $Body;
	}

	public function setStartDate(DateTime|string $StartDate): void
	{
		$this->StartDate = $StartDate instanceof DateTime ? $StartDate->getIso8601() : $StartDate;
	}

	public function setEndDate(DateTime|string|null $EndDate): void
	{
		$this->StartDate = $EndDate instanceof DateTime ? $EndDate->getIso8601() : $EndDate;
	}

	public function setIsGlobal(bool $IsGlobal): void
	{
		$this->IsGlobal = $IsGlobal;
	}

	public function setIsPublished(bool $IsPublished): void
	{
		$this->IsPublished = $IsPublished;
	}

	public function setShowOnlyInCourseOfferings(bool $ShowOnlyInCourseOfferings): void
	{
		$this->ShowOnlyInCourseOfferings = $ShowOnlyInCourseOfferings;
	}

	public function setIsAuthorInfoShown(bool $IsAuthorInfoShown): void
	{
		$this->IsAuthorInfoShown = $IsAuthorInfoShown;
	}

	public function update(): void
	{
		if (!is_null($this->StartDate) && strlen($this->StartDate) == 19)
			$this->StartDate = DateTime::createFromTimestamp($this->StartDate, $this->valence)->getIso8601();

		if (!is_null($this->EndDate) && strlen($this->EndDate) == 19)
			$this->EndDate = DateTime::createFromTimestamp($this->EndDate, $this->valence)->getIso8601();

		$this->valence->updateCourseAnnouncement($this->orgUnitId, $this->newsItemId, $this);
	}
}
