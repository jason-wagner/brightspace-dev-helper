<?php

namespace BrightspaceDevHelper\Valence\Block;

use BrightspaceDevHelper\Valence\Structure\Block;

class GroupData extends Block
{
	public int $GroupId;
	public string $Name;
	public string $Code;
	public RichText $Description;
	public array $Enrollments;

	public function __construct(array $response)
	{
		parent::__construct($response, ['Description']);
		$this->Description = new RichText($response['Description']);
	}
}
