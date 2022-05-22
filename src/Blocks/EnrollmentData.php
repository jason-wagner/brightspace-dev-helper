<?php

namespace BrightspaceDevHelper\Valence\Block;

use BrightspaceDevHelper\Valence\Structure\Block;

class EnrollmentData extends Block
{
	public int $OrgUnitId;
	public int $UserId;
	public int $RoleId;
	public bool $IsCascading;
}
