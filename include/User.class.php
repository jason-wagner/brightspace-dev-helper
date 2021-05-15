<?php

class User {
	protected $valence;
	public $userId;

	public function __construct(Valence $valence, int $userId) {
		$this->valence = $valence;
		$this->userId = $userId;
	}

	public function get() {
		return $this->valence->getUser($this->userId);
	}
}
