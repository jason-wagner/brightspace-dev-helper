<?php

namespace BrightspaceDevHelper\Valence\Client;

use BrightspaceDevHelper\Valence\Block\CourseOffering;
use BrightspaceDevHelper\Valence\Block\EnrollmentData;
use BrightspaceDevHelper\Valence\Block\Forum;
use BrightspaceDevHelper\Valence\Block\GroupCategoryData;
use BrightspaceDevHelper\Valence\Block\GroupData;
use use BrightspaceDevHelper\Valence\Block\Post;
use BrightspaceDevHelper\Valence\Block\SectionData;
use BrightspaceDevHelper\Valence\Block\SectionPropertyData;
use BrightspaceDevHelper\Valence\Block\Topic;

class ValenceCourse
{
	protected $valence;
	public $orgUnitId;

	public function __construct(Valence $valence, int $orgUnitId)
	{
		$this->valence = $valence;
		$this->orgUnitId = $orgUnitId;
	}

	public function get(): ?CourseOffering
	{
		return $this->valence->getCourseOffering($this->orgUnitId);
	}

	public function getImage(string $filepath): bool
	{
		return $this->valence->getCourseImage($this->orgUnitId, $filepath);
	}

	public function uploadCourseImage(string $filepath, string $name): bool
	{
		return $this->valence->uploadCourseImage($this->orgUnitId, $filepath, $name);
	}

	public function enrollUser(int $UserId, int $RoleId): ?EnrollmentData
	{
		return $this->valence->enrollUser($this->orgUnitId, $UserId, $RoleId);
	}

	public function unenrollUser(int $UserId): void
	{
		$this->valence->unenrollUser($UserId, $this->orgUnitId);
	}

	public function getEnrollment(int $userId): ?EnrollmentData
	{
		return $this->valence->getEnrollment($this->orgUnitId, $userId);
	}

	public function enrollStudent(int $UserId): ?EnrollmentData
	{
		return $this->valence->enrollStudent($this->orgUnitId, $UserId);
	}

	public function enrollInstructor(int $UserId): ?EnrollmentData
	{
		return $this->valence->enrollInstructor($this->orgUnitId, $UserId);
	}

	public function getSections(): array
	{
		return $this->valence->getCourseSections($this->orgUnitId);
	}

	public function getSection(int $sectionid): ?SectionData
	{
		return $this->valence->getCourseSection($this->orgUnitId, $sectionid);
	}

	public function createSection(string $Name, string $Code, string $DescriptionText): ?SectionData
	{
		return $this->valence->createCourseSection($this->orgUnitId, $Name, $Code, $DescriptionText);
	}

	public function updateSection(int $sectionId, string $Name, string $Code, string $DescriptionText): ?SectionData
	{
		return $this->valence->updateCourseSection($this->orgUnitId, $sectionId, $Name, $Code, $DescriptionText);
	}

	public function initializeSections(int $EnrollmentStyle, int $EnrollmentQuantity, bool $AuthEnroll, bool $RandomizeEnrollments): ?SectionData
	{
		return $this->valence->initializeCourseSections($this->orgUnitId, $EnrollmentStyle, $EnrollmentQuantity, $AuthEnroll, $RandomizeEnrollments);
	}

	public function deleteSection(int $sectionId): void
	{
		$this->valence->deleteCourseSection($this->orgUnitId, $sectionId);
	}

	public function enrollUserInSection(int $sectionId, int $UserId): array
	{
		return $this->valence->enrollUserInCourseSection($this->orgUnitId, $sectionId, $UserId);
	}

	public function getSectionSettings(): ?SectionPropertyData
	{
		return $this->valence->getCourseSectionSettings($this->orgUnitId);
	}

	public function updateSectionSettings(int $EnrollmentStyle, int $EnrollmentQuantity, bool $AuthEnroll, bool $RandomizeEnrollments): ?SectionPropertyData
	{
		return $this->valence->updateCourseSectionSettings($this->orgUnitId, $EnrollmentStyle, $EnrollmentQuantity, $AuthEnroll, $RandomizeEnrollments);
	}

	public function getGroupCategories(): array
	{
		return $this->valence->getCourseGroupCategories($this->orgUnitId);
	}

	public function getGroupCategory(int $groupCategoryId): ?GroupCategoryData
	{
		return $this->valence->getCourseGroupCategory($this->orgUnitId, $groupCategoryId);
	}

	public function createGroupCategory(string $Name, string $DescriptionText, int $EnrollmentStyle, ?int $EnrollmentQuantity, bool $AutoEnroll, bool $RandomizeEnrollments, ?int $NumberOfGroups, ?int $MaxUsersPerGroup, bool $AllocateAfterExpiry, ?string $SelfEnrollmentExpiryDate, ?string $GroupPrefix, ?int $RestrictedByOrgUnitId): ?GroupCategoryData
	{
		return $this->valence->createCourseGroupCategory($this->orgUnitId, $Name, $DescriptionText, $EnrollmentStyle, $EnrollmentQuantity, $AutoEnroll, $RandomizeEnrollments, $NumberOfGroups, $MaxUsersPerGroup, $AllocateAfterExpiry, $SelfEnrollmentExpiryDate, $GroupPrefix, $RestrictedByOrgUnitId);
	}

	public function deleteGroupCategory(int $groupCategoryId): void
	{
		$this->valence->deleteCourseGroupCategory($this->orgUnitId, $groupCategoryId);
	}

	public function updateGroupCategory(int $groupCategoryId, string $Name, string $DescriptionText, int $EnrollmentType, ?int $EnrollmentQuantity, bool $AutoEnrollment, bool $RandomizeEnrollments, ?int $NumberOfGroups, ?int $MaxUsersPerGroup, bool $AllocateAfterExpiry, ?string $SelfEnrollmentExpiryDate, ?string $GroupPrefix, ?int $RestrictedByOrgUnitId): ?GroupCategoryData
	{
		return $this->valence->updateCourseGroupCategory($this->orgUnitId, $groupCategoryId, $Name, $DescriptionText, $EnrollmentType, $EnrollmentQuantity, $AutoEnrollment, $RandomizeEnrollments, $NumberOfGroups, $MaxUsersPerGroup, $AllocateAfterExpiry, $SelfEnrollmentExpiryDate, $GroupPrefix, $RestrictedByOrgUnitId);
	}

	public function getGroups(int $groupCategoryId): array
	{
		return $this->valence->getCourseGroups($this->orgUnitId, $groupCategoryId);
	}

	public function getGroup(int $groupCategoryId, int $groupId): ?GroupData
	{
		return $this->valence->getCourseGroup($this->orgUnitId, $groupCategoryId, $groupId);
	}

	public function createGroup(int $groupCategoryId, string $Name, string $Code, string $DescriptionText): ?GroupData
	{
		return $this->valence->createCourseGroup($this->orgUnitId, $groupCategoryId, $Name, $Code, $DescriptionText);
	}

	public function updateGroup(int $groupCategoryId, int $groupId, string $Name, string $Code, string $DescriptionText): ?GroupData
	{
		return $this->valence->updateCourseGroup($this->orgUnitId, $groupCategoryId, $groupId, $Name, $Code, $DescriptionText);
	}

	public function enrollUserInGroup(int $groupCategoryId, int $groupId, int $UserId): array
	{
		return $this->valence->enrollUserInGroup($this->orgUnitId, $groupCategoryId, $groupId, $UserId);
	}

	public function unenrollUserFromGroup(int $groupCategoryId, int $groupId, int $userId): void
	{
		$this->valence->unenrollUserFromGroup($this->orgUnitId, $groupCategoryId, $groupId, $userId);
	}

	public function deleteGroup(int $groupCategoryId, int $groupId): void
	{
		$this->valence->deleteCourseGroup($this->orgUnitId, $groupCategoryId, $groupId);
	}

	public function pinForUser(int $userId): void
	{
		$this->valence->pinCourse($this->orgUnitId, $userId);
	}

	public function unpinForUser(int $userId): void
	{
		$this->valence->unpinCourse($this->orgUnitId, $userId);
	}

	public function getDiscussionForums(): array
	{
		return $this->valence->getDiscussionForums($this->orgUnitId);
	}

	public function getDiscussionForum(int $forumId): ?Forum
	{
		return $this->valence->getDiscussionForum($this->orgUnitId, $forumId)
	}

	public function getDiscussionTopics(int $forumId): array
	{
		return $this->valence->getDiscussionTopics($this->orgUnitId, $forumId)
	}

	public function getDiscussionTopic(int $forumId, int $topicId): ?Topic
	{
		return $this->valence->getDiscussionTopic($this->orgUnitId, $forumId, $topicId);
	}

	public function getDiscussionPosts(int $forumId, int $topicId): array
	{
		return $this->valence->getDiscussionPosts($this->orgUnitId, $forumId, $topicId);
	}

	public function getDiscussionPost(int $forumId, int $topicId, int $postId): ?Post
	{
		return $this->valence->getDiscussionPost($this->orgUnitId, $forumId, $topicId, $postId);
	}
}