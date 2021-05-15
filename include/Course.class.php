<?php


class Course {
	protected $valence;
	public $orgUnitId;

	public function __construct(Valence $valence, int $orgUnitId) {
		$this->valence = $valence;
		$this->orgUnitId = $orgUnitId;
	}

	public function get(): array {
		return $this->valence->getCourseOffering($this->orgUnitId);
	}
}
