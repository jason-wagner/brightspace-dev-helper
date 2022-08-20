<?php

namespace BrightspaceDevHelper\Valence\Attributes;

enum ACTIVITYTYPE: int
{
	case UnknownActivity = -1;
	case Module = 0;
	case File = 1;
	case Link = 2;
	case Dropbox = 3;
	case Quiz = 4;
	case DiscussionForum = 5;
	case DiscussionTopic = 6;
	case LTI = 7;
	case Chat = 8;
	case Schedule = 9;
	case Checklist = 10;
	case SelfAssessment = 11;
	case Survey = 12;
	case OnlineRoom = 13;
	case Scorm_1_3 = 20;
	case Scorm_1_3_Root = 21;
	case Scorm_1_2 = 22;
	case Scorm_1_2_Root = 23;
}
