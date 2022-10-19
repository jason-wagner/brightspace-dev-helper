<?php

namespace BrightspaceDevHelper\Valence\Object;

class UserIdKeyPair
{
	public function __construct(public string $userId, public string $userKey)
	{
	}
}
