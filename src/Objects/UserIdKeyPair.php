<?php

namespace BrightspaceDevHelper\Valence\Object;

class UserIdKeyPair
{
	public string $userId;
	public string $userKey;

	public function __construct(string $userId, string $userKey)
	{
		$this->userId = $userId;
		$this->userKey = $userKey;
	}
}
