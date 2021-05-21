<?php

namespace ValenceHelper;

use ValenceHelper\Block\LegalPreferredNames;

class ValenceUser {
	protected $valence;
	public $userId;

	public function __construct(Valence $valence, int $userId) {
		$this->valence = $valence;
		$this->userId = $userId;
	}

	public function get(): array {
		return $this->valence->getUser($this->userId);
	}

	public function getNames(): LegalPreferredNames {
		return $this->valence->getUserNames($this->userId);
	}

	public function updateNames(string $LegalFirstName, string $LegalLastName, ?string $PreferredFirstName, ?string $PreferredLastName): LegalPreferredNames {
		return $this->valence->updateUserNames($this->userId, $LegalFirstName, $LegalLastName, $PreferredFirstName, $PreferredLastName);
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

	public function unenroll(int $orgUnitId): void {
		$this->valence->unenrollUser($this->userId, $orgUnitId);
	}

	public function getEnrollment(int $orgUnitId): array {
		return $this->valence->getEnrollment($orgUnitId, $this->userId);
	}

	public function enrollInCourseSection(int $orgUnitId, int $sectionId): array {
		return $this->valence->enrollUserInCourseSection($orgUnitId, $sectionId, $this->userId);
	}

	public function enrollInGroup(int $orgUnitId, int $groupCategoryId, int $groupId): array {
		return $this->valence->enrollUserInGroup($orgUnitId, $groupCategoryId, $groupId, $this->userId);
	}

	public function unenrollFromGroup(int $orgUnitId, int $groupCategoryId, int $groupId): void {
		$this->valence->unenrollUserFromGroup($orgUnitId, $groupCategoryId, $groupId, $this->userId);
	}
}
