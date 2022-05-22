<?php

namespace BrightspaceDevHelper\Valence\Attributes;

enum SCORING: int
{
	case AverageMessageScore = 1;
	case MaximumMessageScore = 2;
	case MinimumMessageScore = 3;
	case ModeHighestMessageScore = 4;
	case ModeLowestMessageScore = 5;
	case SumOfMessageScores = 6;
}
