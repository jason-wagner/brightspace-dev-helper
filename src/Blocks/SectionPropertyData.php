<?php

namespace BrightspaceDevHelper\Valence\Block;

use BrightspaceDevHelper\Valence\Attributes\SECTENROLL;
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
		parent::__construct($response, ['Description', 'EnrollmentStyle']);
		$this->Description = new RichText($response['Description']);
		$this->EnrollmentStyle = SECTENROLL::tryFrom($response['EnrollmentStyle']);
	}
}
