<?php


class Course {
	protected $valence;
	public $orgid;

	public function __construct(Valence $valence, int $orgid) {
		$this->valence = $valence;
		$this->orgid = $orgid;
	}

	public function get() {
		return $this->valence->getCourseOffering($this->orgid);
	}
}
