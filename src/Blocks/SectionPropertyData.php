<?php

namespace BrightspaceDevHelper\Valence\Block;

use BrightspaceDevHelper\Valence\Attributes\SECTENROLL;
use BrightspaceDevHelper\Valence\Structure\Block;

class SectionPropertyData extends Block
{
	public string $Name;
	public RichText $Description;
	public SECTENROLL $EnrollmentStyle;
	public int $EnrollmentQuantity;
	public int $AutoEnroll;
	public bool $RandomizeEnrollments;

	public function __construct(array $response)
	{
		parent::__construct($response, ['Description', 'EnrollmentStyle']);
		$this->Description = new RichText($response['Description']);
		$this->EnrollmentStyle = SECTENROLL::tryFrom($response['EnrollmentStyle']);
	}
}
