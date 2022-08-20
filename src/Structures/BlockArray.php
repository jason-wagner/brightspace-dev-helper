<?php

namespace BrightspaceDevHelper\Valence\Structure;

use BrightspaceDevHelper\Valence\Client\Valence;
use Iterator;

class BlockArray implements Iterator
{
	public array $data = [];
	public int $pointer = 0;
	public ?string $nextPageRoute = null;
	public string $blockClass;
	public ?Valence $valence;

	public function __construct(array $response, ?Valence $valence = null)
	{
		$this->valence = $valence;
		$this->build($response);
	}

	public function array(): array
	{
		return $this->data;
	}

	public function build(array $response): void
	{
		$this->data = $response;
		$this->pointer = 0;
	}

	public function rewind(): void
	{
		$this->pointer = 0;
	}

	public function current(): mixed
	{
		return $this->valence ? new $this->blockClass($this->data[$this->pointer], $this->valence) : new $this->blockClass($this->data[$this->pointer]);
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
		if (isset($this->data[$this->pointer]))
			return true;

		if ($this->nextPageRoute) {
			$response = (new Valence())->apirequest($this->nextPageRoute);
			$this->build($response);
			return $this->valid();
		}

		return false;
	}
}
