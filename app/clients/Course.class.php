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

	public function unenrollUser(int $UserId): array {
		return $this->valence->unenrollUser($UserId, $this->orgUnitId);
	}

	public function getEnrollment(int $userId): array {
		return $this->valence->getEnrollment($this->orgUnitId, $userId);
	}

	public function enrollStudent(int $UserId): array {
		return $this->valence->enrollStudent($this->orgUnitId, $UserId);
	}

	public function enrollInstructor(int $UserId): array {
		return $this->valence->enrollInstructor($this->orgUnitId, $UserId);
	}

	public function getSections(): array {
		return $this->valence->getCourseSections($this->orgUnitId);
	}

	public function getSection(int $sectionid): array {
		return $this->valence->getCourseSection($this->orgUnitId, $sectionid);
	}

	public function createSection(string $Name, string $Code, string $DescriptionText): array {
		return $this->valence->createCourseSection($this->orgUnitId, $Name, $Code, $DescriptionText);
	}

	public function updateSection(int $sectionId, string $Name, string $Code, string $DescriptionText): array {
		return $this->valence->updateCourseSection($this->orgUnitId, $sectionId, $Name, $Code, $DescriptionText);
	}

	public function initializeSections(int $EnrollmentStyle, int $EnrollmentQuantity, bool $AuthEnroll, bool $RandomizeEnrollments): array {
		return $this->valence->initializeCourseSections($this->orgUnitId, $EnrollmentStyle, $EnrollmentQuantity, $AuthEnroll, $RandomizeEnrollments);
	}

	public function deleteSection(int $sectionId): array {
		return $this->valence->deleteCourseSection($this->orgUnitId, $sectionId);
	}

	public function enrollUserInSection(int $sectionId, int $UserId): array {
		return $this->valence->enrollUserInCourseSection($this->orgUnitId, $sectionId, $UserId);
	}

	public function getSectionSettings(): array {
		return $this->valence->getCourseSectionSettings($this->orgUnitId);
	}

	public function updateSectionSettings(int $EnrollmentStyle, int $EnrollmentQuantity, bool $AuthEnroll, bool $RandomizeEnrollments): array {
		return $this->valence->updateCourseSectionSettings($this->orgUnitId, $EnrollmentStyle, $EnrollmentQuantity, $AuthEnroll, $RandomizeEnrollments);
	}

	public function getGroupCategories(): array {
		return $this->valence->getCourseGroupCategories($this->orgUnitId);
	}

	public function getGroupCategory(int $groupCategoryId): array {
		return $this->valence->getCourseGroupCategory($this->orgUnitId, $groupCategoryId);
	}

	public function createGroupCategory(string $Name, string $DescriptionText, int $EnrollmentStyle, ?int $EnrollmentQuantity, bool $AutoEnroll, bool $RandomizeEnrollments, ?int $NumberOfGroups, ?int $MaxUsersPerGroup, bool $AllocateAfterExpiry, ?string $SelfEnrollmentExpiryDate, ?string $GroupPrefix, ?int $RestrictedByOrgUnitId): array {
		return $this->valence->createCourseGroupCategory($this->orgUnitId, $Name, $DescriptionText, $EnrollmentStyle, $EnrollmentQuantity, $AutoEnroll, $RandomizeEnrollments, $NumberOfGroups, $MaxUsersPerGroup, $AllocateAfterExpiry, $SelfEnrollmentExpiryDate, $GroupPrefix, $RestrictedByOrgUnitId);
	}

	public function deleteGroupCategory(int $groupCategoryId): array {
		return $this->valence->deleteCourseGroupCategory($this->orgUnitId, $groupCategoryId);
	}

	public function updateGroupCategory(int $groupCategoryId, string $Name, string $DescriptionText, int $EnrollmentType, ?int $EnrollmentQuantity, bool $AutoEnrollment, bool $RandomizeEnrollments, ?int $NumberOfGroups, ?int $MaxUsersPerGroup, bool $AllocateAfterExpiry, ?string $SelfEnrollmentExpiryDate, ?string $GroupPrefix, ?int $RestrictedByOrgUnitId): array {
		return $this->valence->updateCourseGroupCategory($this->orgUnitId, $groupCategoryId, $Name, $DescriptionText, $EnrollmentType, $EnrollmentQuantity, $AutoEnrollment, $RandomizeEnrollments, $NumberOfGroups, $MaxUsersPerGroup, $AllocateAfterExpiry, $SelfEnrollmentExpiryDate, $GroupPrefix, $RestrictedByOrgUnitId);
	}

	public function getGroups(int $groupCategoryId): array {
		return $this->valence->getCourseGroups($this->orgUnitId, $groupCategoryId);
	}

	public function getGroup(int $groupCategoryId, int $groupId): array {
		return $this->valence->getCourseGroup($this->orgUnitId, $groupCategoryId, $groupId);
	}

	public function createGroup(int $groupCategoryId, string $Name, string $Code, string $DescriptionText): array {
		return $this->valence->createCourseGroup($this->orgUnitId, $groupCategoryId, $Name, $Code, $DescriptionText);
	}

	public function updateGroup(int $groupCategoryId, int $groupId, string $Name, string $Code, string $DescriptionText): array {
		return $this->valence->updateCourseGroup($this->orgUnitId, $groupCategoryId, $groupId, $Name, $Code, $DescriptionText);
	}

	public function enrollUserInGroup(int $groupCategoryId, int $groupId, int $UserId): array {
		return $this->valence->enrollUserInGroup($this->orgUnitId, $groupCategoryId, $groupId, $UserId);
	}

	public function unenrollUserFromGroup(int $groupCategoryId, int $groupId, int $userId): array {
		return $this->valence->unenrollUserFromGroup($this->orgUnitId, $groupCategoryId, $groupId, $userId);
	}

	public function deleteGroup(int $groupCategoryId, int $groupId): array {
		return $this->valence->deleteCourseGroup($this->orgUnitId, $groupCategoryId, $groupId);
	}
}
