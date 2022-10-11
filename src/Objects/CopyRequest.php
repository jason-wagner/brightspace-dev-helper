<?php

namespace BrightspaceDevHelper\Valence\Object;

use BrightspaceDevHelper\Valence\Attributes\COPYJOBSTATUS;
use BrightspaceDevHelper\Valence\Client\Valence;
use BrightspaceDevHelper\Valence\CreateBlock\CreateCopyJobRequest;

class CopyRequest
{
	public ?COPYJOBSTATUS $status = null;
	public ?string $jobToken = null;

	public function __construct(public Valence $valence, public int $orgUnitId, public CreateCopyJobRequest $request)
	{
	}

	public function copy(): void
	{
		$this->jobToken = $this->valence->createCourseCopyRequest($this->orgUnitId, $this->request)->JobToken;
	}

	public function status(): ?bool
	{
		if (is_null($this->status?->getResult()))
			$this->status = $this->valence->getCourseCopyJobStatus($this->orgUnitId, $this->jobToken)->Status;

		return $this->status->getResult();
	}
}
