<?php

namespace BrightspaceDevHelper\Valence\Structure;

use BrightspaceDevHelper\Valence\Client\Valence;

class BlockArray
{
	public $data = [];
	public $pointer = 0;
	public $nextPageRoute = null;
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
		if(array_key_exists($this->pointer, $this->data))
			return $this->data[$this->pointer++];

		if($this->nextPageRoute) {
			$response = (new Valence())->apirequest($this->nextPageRoute);
			$this->build($response);
			$this->pointer = 0;
			return $this->next();
		}

		return null;
	}
}
