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

	public function enrollUser(int $UserId, int $RoleId): array {
		return $this->valence->enrollUser($this->orgUnitId, $UserId, $RoleId);
	}

	public function enrollStudent(int $UserId): array {
		return $this->valence->enrollStudent($this->orgUnitId, $UserId);
	}

	public function enrollInstructor(int $UserId): array {
		return $this->valence->enrollInstructor($this->orgUnitId, $UserId);
	}
}
