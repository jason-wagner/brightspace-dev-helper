<?php

namespace BrightspaceDevHelper\Valence\UpdateBlock;

use BrightspaceDevHelper\Valence\Client\Valence;
use BrightspaceDevHelper\Valence\CreateBlock\RichTextInput;
use BrightspaceDevHelper\Valence\Structure\UpdateBlock;

class CourseOfferingInfo extends UpdateBlock
{
	protected array $nonprops = ['orgUnitId'];

	public int $orgUnitId;
	public string $Name;
	public string $Code;
	public bool $IsActive;
	public ?string $StartDate;
	public ?string $EndDate;
	public RichTextInput $Description;
	public bool $CanSelfRegister;

	public function __construct(Valence $valence, int $orgUnitId, string $Name, string $Code, bool $IsActive, ?string $StartDate, ?string $EndDate, RichTextInput $Description, bool $CanSelfRegister)
	{
		$this->valence = $valence;
	}

	public function update(): void
	{
		$this->valence->updateCourseOffering($this->orgUnitId, $this);
	}
}
