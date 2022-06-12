<?php

namespace BrightspaceDevHelper\Valence\Attributes;

enum COPYJOBSTATUS: string
{
	case PENDING = 'PENDING';
	case PROCESSING = 'PROCESSING';
	case COMPLETE = 'COMPLETE';
	case FAILED = 'FAILED';
	case CANCELLED = 'CANCELLED';

	public function getResult(): ?bool
	{
		return match ($this) {
			COPYJOBSTATUS::COMPLETE => true,
			COPYJOBSTATUS::FAILED, COPYJOBSTATUS::CANCELLED => false,
			COPYJOBSTATUS::PENDING, COPYJOBSTATUS::PROCESSING => null
		};
	}
}
