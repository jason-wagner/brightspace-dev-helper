<?php

class User {
	protected $valence;
	public $userId;

	public function __construct(Valence $valence, int $userId) {
		$this->valence = $valence;
		$this->userId = $userId;
	}

	public function get(): array {
		return $this->valence->getUser($this->userId);
	}

	public function enrollInCourse(int $OrgUnitId, int $RoleId): array {
		return $this->valence->enrollUser($OrgUnitId, $this->userId, $RoleId);
	}

	public function enrollAsStudent(int $OrgUnitId): array {
		return $this->valence->enrollStudent($OrgUnitId, $this->userId);
	}

	public function enrollAsInstructor(int $OrgUnitId): array {
		return $this->valence->enrollInstructor($OrgUnitId, $this->userId);
	}
}
