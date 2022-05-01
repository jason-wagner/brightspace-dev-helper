<?php

namespace BrightspaceDevHelper\Valence\Block;

use BrightspaceDevHelper\Valence\Structure\Block;

class SectionData extends Block
{
	public $SectionId;
	public $Name;
	public $Code;
	public $Description;
	public $Enrollments;

	public function __construct(array $response)
	{
		parent::__construct($response, ['Description']);
		$this->Description = new RichText($response['Description']);
	}
}
