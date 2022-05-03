<?php

namespace BrightspaceDevHelper\Valence\Structure;

class BlockArray
{
	public $data = [];
	public $pointer = 0;
	public $blockClass;

	public function __construct(array $response)
	{
		$this->build($response);
	}

	public function array(): array
	{
		return $this->data;
	}

	public function build(array $response): void
	{
		$this->data = [];

		foreach($response as $item)
			$this->data[] = new $this->blockClass($item);
	}

	public function next()
	{
		return $this->data[$this->pointer++] ?? null;
	}
}
