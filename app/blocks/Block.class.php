<?php

namespace ValenceHelper;

class Block {
	public function __construct(array $response) {
		foreach($response as $key => $value)
			$this->$key = $value;
	}
}
