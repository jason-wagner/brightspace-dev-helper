<?php

namespace BrightspaceDevHelper\Valence\Block;

use BrightspaceDevHelper\Valence\Block;

class GroupData extends Block
{
	public $GroupId;
	public $Name;
	public $Description;
	public $Enrollments;

	public function __construct(array $response)
	{
		foreach (['GroupId', 'Name', 'Enrollments'] as $key)
			$this->$key = $response[$key];

		$this->Description = new RichText($response['Description']);
	}
}
