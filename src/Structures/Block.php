<?php

namespace BrightspaceDevHelper\Valence\Structure;

class Block
{
	protected array $nonprops = [];

	public function __construct(array $response, array $skip = [])
	{
		foreach ($response as $key => $value)
			if (!in_array($key, $skip))
				$this->$key = $value;
	}

	public function toArray()
	{
		$a = [];

		foreach ($this as $k => $v)
			if (!in_array($k, ['valence', 'nonprops']) && !in_array($k, $this->nonprops))
				$a[$k] = is_object($v) ? $v->toArray() : $v;

		return $a;
	}
}
