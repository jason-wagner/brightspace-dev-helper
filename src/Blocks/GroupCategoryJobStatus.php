<?php

namespace BrightspaceDevHelper\Valence\Block;

use BrightspaceDevHelper\Valence\Attributes\GROUPSJOBSTATUS;
use BrightspaceDevHelper\Valence\Client\Valence;
use BrightspaceDevHelper\Valence\Structure\Block;

class GroupCategoryJobStatus extends Block
{
	public GROUPSJOBSTATUS $Status;

	public function __construct(array $response, Valence $valence)
	{
		$this->Status = GROUPSJOBSTATUS::tryFrom($response['Status']);
	}
}
