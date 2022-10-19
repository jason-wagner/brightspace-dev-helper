<?php

namespace BrightspaceDevHelper\Valence\Object;

class BrightspaceConfig
{
	public function __construct(public string $host,
								public string $port,
								public string $scheme,
								public string $appId,
								public string $appKey,
								public string $userId,
								public string $userKey)
	{
	}
}
