<?php

namespace BrightspaceDevHelper\Valence\Block;

use BrightspaceDevHelper\Valence\Attributes\COPYJOBSTATUS;
use BrightspaceDevHelper\Valence\Structure\Block;

class GetCopyJobResponse extends Block
{
	public COPYJOBSTATUS $Status;

	public function __construct(array $response)
	{
		$this->Status = COPYJOBSTATUS::tryFrom($response['Status']);
	}
}
