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
		foreach (['Name', 'EnrollmentStyle', 'AutoEnroll', 'RandomizeEnrollments', 'NumberOfGroups', 'MaxUsersPerGroup', 'AllocateAfterExpiry', 'SelfEnrollmentExpiryDate', 'GroupPrefix', 'RestrictedByOrgUnitId'] as $key)
			$this->$key = $response[$key];

		$this->Description = new RichText($response['Description']);
	}
}
