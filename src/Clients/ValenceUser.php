<?php

namespace BrightspaceDevHelper\Valence\Client;

use BrightspaceDevHelper\Valence\Block\EnrollmentData;
use BrightspaceDevHelper\Valence\Block\LegalPreferredNames;
use BrightspaceDevHelper\Valence\Block\UserData;
use BrightspaceDevHelper\Valence\CreateBlock\CreateEnrollmentData;
use BrightspaceDevHelper\Valence\CreateBlock\GroupEnrollment;
use BrightspaceDevHelper\Valence\CreateBlock\SectionEnrollment;

class ValenceUser
{
	protected Valence $valence;
	public int $userId;

	public function __construct(Valence $valence, int $userId)
	{
		$this->valence = $valence;
		$this->userId = $userId;
	}

	public function get(): ?UserData
	{
		return $this->valence->getUser($this->userId);
	}

	public function getNames(): LegalPreferredNames
	{
		return $this->valence->getUserNames($this->userId);
	}

	public function updateNames(string $LegalFirstName, string $LegalLastName, ?string $PreferredFirstName, ?string $PreferredLastName): LegalPreferredNames
	{
		return $this->valence->updateUserNames($this->userId, $LegalFirstName, $LegalLastName, $PreferredFirstName, $PreferredLastName);
	}

	public function getProfile(): ?array
	{
		return $this->valence->getUserProfile($this->userId);
	}

	public function getPicture(string $filepath): bool
	{
		return $this->valence->getUserPicture($this->userId, $filepath);
	}

	public function uploadPicture(string $filepath): bool
	{
		return $this->valence->uploadUserPicture($this->userId, $filepath);
	}

	public function deletePicture(): void
	{
		$this->valence->deleteUserPicture($this->userId);
	}

	public function enrollInCourse(int $OrgUnitId, int $RoleId): ?EnrollmentData
	{
		return $this->valence->enrollUser(new CreateEnrollmentData($this->valence, $OrgUnitId, $this->userId, $RoleId));
	}

	public function enrollAsStudent(int $OrgUnitId): ?EnrollmentData
	{
		return $this->valence->enrollStudent($OrgUnitId, $this->userId);
	}

	public function enrollAsInstructor(int $OrgUnitId): ?EnrollmentData
	{
		return $this->valence->enrollInstructor($OrgUnitId, $this->userId);
	}

	public function unenroll(int $orgUnitId): void
	{
		$this->valence->unenrollUser($this->userId, $orgUnitId);
	}

	public function getEnrollment(int $orgUnitId): ?EnrollmentData
	{
		return $this->valence->getEnrollment($orgUnitId, $this->userId);
	}

	public function enrollInCourseSection(int $orgUnitId, int $sectionId): void
	{
		$this->valence->enrollUserInCourseSection($orgUnitId, $sectionId, new SectionEnrollment($this->valence, $orgUnitId, $sectionId, $this->userId));
	}

	public function enrollInGroup(int $orgUnitId, int $groupCategoryId, int $groupId): void
	{
		$this->valence->enrollUserInGroup($orgUnitId, $groupCategoryId, $groupId, new GroupEnrollment($this->valence, $orgUnitId, $groupCategoryId, $groupId, $this->userId));
	}

	public function unenrollFromGroup(int $orgUnitId, int $groupCategoryId, int $groupId): void
	{
		$this->valence->unenrollUserFromGroup($orgUnitId, $groupCategoryId, $groupId, $this->userId);
	}

	public function pinCourse(int $orgUnitId): void
	{
		$this->valence->pinCourse($orgUnitId, $this->userId);
	}

	public function unpinCourse(int $orgUnitId): void
	{
		$this->valence->unpinCourse($orgUnitId, $this->userId);
	}
}
