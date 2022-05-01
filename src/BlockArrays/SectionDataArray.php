<?php

namespace BrightspaceDevHelper\Valence\BlockArray;

use BrightspaceDevHelper\Valence\Block\SectionData;
use BrightspaceDevHelper\Valence\Structure\BlockArray;

class SectionDataArray extends BlockArray
{
	public function __construct(array $response)
	{
		$this->data = [];

		foreach ($response as $block)
			$this->data[] = new SectionData($block);
	}

	public function next(): ?SectionData
	{
		return $this->data[$this->pointer++] ?? null;
	}
}
