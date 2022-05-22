<?php

namespace BrightspaceDevHelper\Valence\Block;

use BrightspaceDevHelper\Valence\Structure\Block;

class Role extends Block
{
	public string $Identifier;
	public string $DisplayName;
	public string $Code;
	public string $Description;
	public string $RoleAlias;
	public bool $IsCascading;
	public bool $AccessFutureCourses;
	public bool $AccessInactiveCourses;
	public bool $AccessPastCourses;
	public bool $ShowInGrades;
	public bool $ShowInUserProgress;
	public bool $InClassList;
}
