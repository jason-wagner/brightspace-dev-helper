<?php

namespace BrightspaceDevHelper\Valence\Block;

use BrightspaceDevHelper\Valence\Block;

class Role extends Block
{
	public $Identifier;
	public $DisplayName;
	public $Code;
	public $Description;
	public $RoleAlias;
	public $IsCascading;
	public $AccessFutureCourses;
	public $AccessInactiveCourses;
	public $AccessPastCourses;
	public $ShowInGrades;
	public $ShowInUserProgress;
	public $InClassList;
}
