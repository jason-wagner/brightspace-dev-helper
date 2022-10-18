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

	public function toArray(): array
	{
		$data = [];

		foreach ($this as $key => $value)
			if (!in_array($key, ['valence', 'nonprops']) && !in_array($key, $this->nonprops))
				$data[$key] = is_object($value) ? $value->toArray() : $value;

		return $data;
	}
}
