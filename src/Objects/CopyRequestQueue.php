<?php

namespace BrightspaceDevHelper\Valence\Object;

use \Iterator;

class CopyRequestQueue implements Iterator
{
	public array $data = [];
	public int $pointer = 0;

	public function add(CopyRequest $request): void
	{
		$this->data[] = $request;
	}

	public function rewind(): void
	{
		$this->pointer = 0;
	}

	public function current(): CopyRequest
	{
		return $this->data[$this->pointer];
	}

	public function key(): mixed
	{
		return $this->pointer;
	}

	public function next(): void
	{
		$this->pointer++;
	}

	public function valid(): bool
	{
		return isset($this->data[$this->pointer]);
	}
}
