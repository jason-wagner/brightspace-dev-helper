<?php

namespace BrightspaceDevHelper\Valence\Block;

use BrightspaceDevHelper\Valence\Attributes\GROUPSJOBSTATUS;
use BrightspaceDevHelper\Valence\Client\Valence;
use BrightspaceDevHelper\Valence\Structure\Block;

class GroupsJobData extends Block
{
	public int $OrgUnitId;
	public int $CategoryId;
	public int $SubmitDate;
	public GROUPSJOBSTATUS $Status;

	public function __construct(array $response, Valence $valence)
	{
		parent::__construct($response, ['SubmitDate', 'Status']);

		$this->SubmitDate = $valence->createDateTimeFromIso8601($response['SubmitDate'])->getTimestamp();
		$this->Status = GROUPSJOBSTATUS::tryFrom($response['Status']);
	}
}
