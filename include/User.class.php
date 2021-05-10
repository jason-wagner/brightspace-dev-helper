<?php

class User {
	protected $valence;
	public $userid;

	public function __construct(Valence $valence, int $userid) {
		$this->valence = $valence;
		$this->userid = $userid;
	}

	public function get() {
		return $this->valence->apirequest("/d2l/api/lp/".Valence::VERSION_LP."/profile/user/{$this->userid}");
	}
}
