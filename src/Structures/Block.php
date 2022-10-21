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

		foreach ($this as $key => $value) {
			if (in_array($key, ['valence', 'nonprops']) || in_array($key, $this->nonprops))
				continue;

			if ($value instanceof \UnitEnum)
				$data[$key] = $value->value;
			elseif (is_object($value))
				$data[$key] = $value->toArray();
			else
				$data[$key] = $value;
		}

		return $data;
	}
}
