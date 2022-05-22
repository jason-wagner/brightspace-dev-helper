<?php

namespace BrightspaceDevHelper\Valence\Attributes;

enum GRPENROLL: int
{
	case NumberOfGroupsNoEnrollment = 0;
	case PeoplePerGroupAutoEnrollment = 1;
	case NumberOfGroupsAutoEnrollment = 2;
	case PeoplePerGroupSelfEnrollment = 3;
	case SelfEnrollmentNumberOfGroups = 4;
	case PeoplePerNumberOfGroupsSelfEnrollment = 5;
	case SingleUserMemberSpecificGroup = 6;
}
