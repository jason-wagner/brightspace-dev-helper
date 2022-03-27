<?php

namespace ValenceHelper\Block;

use ValenceHelper\Block;

class SectionData extends Block
{
	public $SectionId;
	public $Name;
	public $Code;
	public $Description;
	public $Enrollments;

	public function __construct(array $response)
	{
		foreach (['SectionId', 'Name', 'Code', 'Enrollments'] as $key)
			$this->$key = $response[$key];

		$this->Description = new RichText($response['Description']);
	}
}
