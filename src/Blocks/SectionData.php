<?php

namespace BrightspaceDevHelper\Valence\Block;

use BrightspaceDevHelper\Valence\Structure\Block;

class SectionData extends Block
{
	public int $SectionId;
	public string $Name;
	public string $Code;
	public RichText $Description;
	public array $Enrollments;

	public function __construct(array $response)
	{
		parent::__construct($response, ['Description']);
		$this->Description = new RichText($response['Description']);
	}
}
