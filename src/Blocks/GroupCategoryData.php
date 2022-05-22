<?php

namespace BrightspaceDevHelper\Valence\Block;

use BrightspaceDevHelper\Valence\Attributes\GRPENROLL;
use BrightspaceDevHelper\Valence\Structure\Block;

class GroupCategoryData extends Block
{
	public int $GroupCategoryId;
	public string $Name;
	public RichText $Description;
	public GRPENROLL $EnrollmentStyle;
	public ?int $EnrollmentQuantity;
	public ?int $MaxUsersPerGroup;
	public bool $AutoEnroll;
	public bool $RandomizeEnrollments;
	public array $Groups;
	public bool $AllocateAfterExpiry;
	public ?string $SelfEnrollmentExpiryDate;
	public ?int $RestrictedByOrgUnitId;

	public function __construct(array $response)
	{
		parent::__construct($response, ['Description', 'EnrollmentStyle']);
		$this->Description = new RichText($response['Description']);
		$this->EnrollmentStyle = GRPENROLL::tryFrom($response['EnrollmentStyle'])
	}
}
