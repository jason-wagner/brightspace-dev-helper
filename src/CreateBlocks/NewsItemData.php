<?php

namespace BrightspaceDevHelper\Valence\CreateBlock;

use BrightspaceDevHelper\Valence\Block\NewsItem;
use BrightspaceDevHelper\Valence\Block\RichText;
use BrightspaceDevHelper\Valence\Client\Valence;
use BrightspaceDevHelper\Valence\Object\DateTime;
use BrightspaceDevHelper\Valence\Structure\CreateBlock;

class NewsItemData extends CreateBlock
{
	protected array $nonprops = ['orgUnitId'];

	public function __construct(Valence                     $valence,
								public int                  $orgUnitId,
								public string               $Title,
								public RichText             $Body,
								public DateTime|string      $StartDate,
								public DateTime|string|null $EndDate,
								public bool                 $IsGlobal,
								public bool                 $IsPublished,
								public int                  $ShowOnlyInCourseOfferings,
								public bool                 $IsAuthorInfoShown)
	{
		$this->valence = $valence;

		if ($this->StartDate instanceof DateTime)
			$this->StartDate = $this->StartDate->getIso8601();

		if ($this->EndDate instanceof DateTime)
			$this->EndDate = $this->EndDate->getIso8601();
	}

	public function create(): NewsItem
	{
		return $this->valence->postCourseAnnouncement($this->orgUnitId, $this);
	}
}
