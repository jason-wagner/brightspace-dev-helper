<?php

namespace BrightspaceDevHelper\Valence\Attributes;

enum RATING: int
{
	case None = 0;
	case FiveStar = 1;
	case UpVoteDownVote = 2;
	case UpVoteOnly = 3;
}
