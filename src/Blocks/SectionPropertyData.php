<?php

namespace BrightspaceDevHelper\Valence\Block;

use BrightspaceDevHelper\Valence\Structure\Block;

class SectionPropertyData extends Block
{
	public $Name;
	public $Description;
	public $EnrollmentStyle;
	public $EnrollmentQuantity;
	public $AutoEnroll;
	public $RandomizeEnrollments;

	public function __construct(array $response)
	{
		foreach (['Name', 'EnrollmentStyle', 'EnrollmentQuantity', 'AutoEnroll', 'RandomizeEnrollments'] as $key)
			$this->$key = $response[$key];

		$this->Description = new RichText($response['Description']);
	}
}
