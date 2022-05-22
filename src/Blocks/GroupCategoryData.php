<?php

namespace BrightspaceDevHelper\Valence\Block;

use BrightspaceDevHelper\Valence\Attributes\GRPENROLL;
use BrightspaceDevHelper\Valence\Structure\Block;

class GroupCategoryData extends Block
{
	public $Name;
	public $Description;
	public $EnrollmentStyle;
	public $AutoEnroll;
	public $RandomizeEnrollments;
	public $NumberOfGroups;
	public $MaxUsersPerGroup;
	public $AllocateAfterExpiry;
	public $SelfEnrollmentExpiryDate;
	public $GroupPrefix;
	public $RestrictedByOrgUnitId;

	public function __construct(array $response)
	{
		parent::__construct($response, ['Description', 'EnrollmentStyle']);
		$this->Description = new RichText($response['Description']);
		$this->EnrollmentStyle = GRPENROLL::tryFrom($response['EnrollmentStyle'])
	}
}
