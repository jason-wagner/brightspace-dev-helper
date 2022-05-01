<?php

namespace BrightspaceDevHelper\Valence\Block;

use BrightspaceDevHelper\Valence\Structure\Block;

class GroupData extends Block
{
	public $GroupId;
	public $Name;
	public $Description;
	public $Enrollments;

	public function __construct(array $response)
	{
		parent::__construct($response, ['Description']);
		$this->Description = new RichText($response['Description']);
	}
}
