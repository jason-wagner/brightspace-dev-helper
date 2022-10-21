<?php

namespace BrightspaceDevHelper\Valence\CreateBlock;

use BrightspaceDevHelper\Valence\Attributes\GRPENROLL;
use BrightspaceDevHelper\Valence\Block\GroupsJobData;
use BrightspaceDevHelper\Valence\Client\Valence;
use BrightspaceDevHelper\Valence\Structure\CreateBlock;

class GroupCategoryDataCreate extends CreateBlock
{
	protected array $nonprops = ['orgUnitId', 'groupCategoryId'];

	public function __construct(Valence          $valence,
								public int       $orgUnitId,
								public string    $Name,
								public string    $DescriptionText,
								public GRPENROLL $EnrollmentStyle,
								public ?int      $EnrollmentQuantity,
								public bool      $AutoEnroll,
								public bool      $RandomizeEnrollments,
								public ?int      $NumberOfGroups,
								public ?int      $MaxUsersPerGroup,
								public bool      $AllocateAfterExpiry,
								public ?string   $SelfEnrollmentExpiryDate,
								public ?string   $GroupPrefix,
								public ?int      $RestrictedByOrgUnitId)
	{
		$this->valence = $valence;
	}

	public function create(): GroupsJobData
	{
		return $this->valence->createCourseGroupCategory($this->orgUnitId, $this);
	}
}
