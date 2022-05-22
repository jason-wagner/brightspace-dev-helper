<?php

namespace BrightspaceDevHelper\Valence\Attributes;

enum AVAILABILITY: int
{
	case AccessRestricted = 0;
	case SubmissionRestricted = 1;
	case Hidden = 2;
}
