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
		$this->data = $response;
		$this->pointer = 0;
	}

	public function rewind(): void
	{
		$this->pointer = 0;
	}

	public function current(): mixed
	{
		return new $this->blockClass($this->data[$this->pointer]);
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
		$isSet = isset($this->data[$this->pointer]);

		if($isSet)
			return true;

		if($this->nextPageRoute) {
			$response = (new Valence())->apirequest($this->nextPageRoute);
			$this->build($response);
			return $this->valid();
		}

		return false;
	}
}
