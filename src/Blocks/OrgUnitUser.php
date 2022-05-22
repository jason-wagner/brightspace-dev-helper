<?php

namespace BrightspaceDevHelper\Valence\Block;

use BrightspaceDevHelper\Valence\Structure\Block;

class OrgUnitUser extends Block
{
	public $User;
	public $Role;

	public function __construct(array $response)
	{
		$this->User = new User($response['User']);
		$this->Role = new RoleInfo($response['Role']);
	}
}
