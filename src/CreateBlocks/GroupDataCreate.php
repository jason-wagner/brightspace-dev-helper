<?php

namespace BrightspaceDevHelper\Valence\CreateBlock;

use BrightspaceDevHelper\Valence\Block\GroupData;
use BrightspaceDevHelper\Valence\Client\Valence;
use BrightspaceDevHelper\Valence\Structure\CreateBlock;

class GroupDataCreate extends CreateBlock
{
	protected array $nonprops = ['orgUnitId', 'groupCategoryId'];

	public function __construct(Valence       $valence,
								public int    $orgUnitId,
								public int    $groupCategoryId,
								public string $Name,
								public string $Code,
								RichTextInput $Description)
	{
		$this->valence = $valence;
	}

	public function create(): GroupData
	{
		return $this->valence->createCourseGroup($this->orgUnitId, $this->groupCategoryId, $this);
	}
}
