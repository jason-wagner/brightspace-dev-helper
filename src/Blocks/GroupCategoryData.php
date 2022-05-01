<?php

namespace BrightspaceDevHelper\Valence\Block;

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
		parent::__construct($response, ['Description']);
		$this->Description = new RichText($response['Description']);
	}
}
