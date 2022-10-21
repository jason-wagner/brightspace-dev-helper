<?php

namespace BrightspaceDevHelper\Valence\CreateBlock;

use BrightspaceDevHelper\Valence\Block\SectionData;
use BrightspaceDevHelper\Valence\Client\Valence;
use BrightspaceDevHelper\Valence\Structure\CreateBlock;

class SectionDataCreate extends CreateBlock
{
	protected array $nonprops = ['orgUnitId'];

	public function __construct(Valence       $valence,
								public int    $orgUnitId,
								public string $Name,
								public string $Code,
								RichTextInput $Description)
	{
		$this->valence = $valence;
	}

	public function create(): SectionData
	{
		return $this->valence->createCourseSection($this->orgUnitId, $this);
	}
}
