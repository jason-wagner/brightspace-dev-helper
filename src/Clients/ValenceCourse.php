<?php

namespace BrightspaceDevHelper\Valence\Client;

use BrightspaceDevHelper\Valence\Attributes\GRPENROLL;
use BrightspaceDevHelper\Valence\Attributes\SECTENROLL;
use BrightspaceDevHelper\Valence\Block\CourseOffering;
use BrightspaceDevHelper\Valence\Block\CreateCopyJobResponse;
use BrightspaceDevHelper\Valence\Block\EnrollmentData;
use BrightspaceDevHelper\Valence\Block\Forum;
use BrightspaceDevHelper\Valence\Block\GetCopyJobResponse;
use BrightspaceDevHelper\Valence\Block\GroupCategoryData;
use BrightspaceDevHelper\Valence\Block\GroupData;
use BrightspaceDevHelper\Valence\Block\NewsItem;
use BrightspaceDevHelper\Valence\Block\Post;
use BrightspaceDevHelper\Valence\Block\SectionData;
use BrightspaceDevHelper\Valence\Block\SectionPropertyData;
use BrightspaceDevHelper\Valence\Block\TableOfContents;
use BrightspaceDevHelper\Valence\Block\Topic;

use BrightspaceDevHelper\Valence\BlockArray\ForumArray;
use BrightspaceDevHelper\Valence\BlockArray\GroupCategoryDataArray;
use BrightspaceDevHelper\Valence\BlockArray\GroupDataArray;
use BrightspaceDevHelper\Valence\BlockArray\NewsItemArray;
use BrightspaceDevHelper\Valence\BlockArray\OrgUnitUserArray;
use BrightspaceDevHelper\Valence\BlockArray\PostArray;
use BrightspaceDevHelper\Valence\BlockArray\SectionDataArray;
use BrightspaceDevHelper\Valence\BlockArray\TopicArray;
use BrightspaceDevHelper\Valence\CreateBlock\CreateCopyJobRequest;
use BrightspaceDevHelper\Valence\CreateBlock\NewsItemData;

class ValenceCourse
{
	protected Valence $valence;
	public int $orgUnitId;

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

	public function getEnrollments(): ?OrgUnitUserArray
	{
		return $this->valence->getEnrollments($this->orgUnitId);
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

	public function getSections(): SectionDataArray
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

	public function initializeSections(SECTENROLL $EnrollmentStyle, int $EnrollmentQuantity, bool $AuthEnroll, bool $RandomizeEnrollments): ?SectionData
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

	public function updateSectionSettings(SECTENROLL $EnrollmentStyle, int $EnrollmentQuantity, bool $AuthEnroll, bool $RandomizeEnrollments): ?SectionPropertyData
	{
		return $this->valence->updateCourseSectionSettings($this->orgUnitId, $EnrollmentStyle, $EnrollmentQuantity, $AuthEnroll, $RandomizeEnrollments);
	}

	public function getGroupCategories(): GroupCategoryDataArray
	{
		return $this->valence->getCourseGroupCategories($this->orgUnitId);
	}

	public function getGroupCategory(int $groupCategoryId): ?GroupCategoryData
	{
		return $this->valence->getCourseGroupCategory($this->orgUnitId, $groupCategoryId);
	}

	public function createGroupCategory(string $Name, string $DescriptionText, GRPENROLL $EnrollmentStyle, ?int $EnrollmentQuantity, bool $AutoEnroll, bool $RandomizeEnrollments, ?int $NumberOfGroups, ?int $MaxUsersPerGroup, bool $AllocateAfterExpiry, ?string $SelfEnrollmentExpiryDate, ?string $GroupPrefix, ?int $RestrictedByOrgUnitId): ?GroupCategoryData
	{
		return $this->valence->createCourseGroupCategory($this->orgUnitId, $Name, $DescriptionText, $EnrollmentStyle, $EnrollmentQuantity, $AutoEnroll, $RandomizeEnrollments, $NumberOfGroups, $MaxUsersPerGroup, $AllocateAfterExpiry, $SelfEnrollmentExpiryDate, $GroupPrefix, $RestrictedByOrgUnitId);
	}

	public function deleteGroupCategory(int $groupCategoryId): void
	{
		$this->valence->deleteCourseGroupCategory($this->orgUnitId, $groupCategoryId);
	}

	public function updateGroupCategory(int $groupCategoryId, string $Name, string $DescriptionText, GRPENROLL $EnrollmentType, ?int $EnrollmentQuantity, bool $AutoEnrollment, bool $RandomizeEnrollments, ?int $NumberOfGroups, ?int $MaxUsersPerGroup, bool $AllocateAfterExpiry, ?string $SelfEnrollmentExpiryDate, ?string $GroupPrefix, ?int $RestrictedByOrgUnitId): ?GroupCategoryData
	{
		return $this->valence->updateCourseGroupCategory($this->orgUnitId, $groupCategoryId, $Name, $DescriptionText, $EnrollmentType, $EnrollmentQuantity, $AutoEnrollment, $RandomizeEnrollments, $NumberOfGroups, $MaxUsersPerGroup, $AllocateAfterExpiry, $SelfEnrollmentExpiryDate, $GroupPrefix, $RestrictedByOrgUnitId);
	}

	public function getGroups(int $groupCategoryId): GroupDataArray
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

	public function getDiscussionForums(): ForumArray
	{
		return $this->valence->getDiscussionForums($this->orgUnitId);
	}

	public function getDiscussionForum(int $forumId): ?Forum
	{
		return $this->valence->getDiscussionForum($this->orgUnitId, $forumId);
	}

	public function getDiscussionTopics(int $forumId): TopicArray
	{
		return $this->valence->getDiscussionTopics($this->orgUnitId, $forumId);
	}

	public function getDiscussionTopic(int $forumId, int $topicId): ?Topic
	{
		return $this->valence->getDiscussionTopic($this->orgUnitId, $forumId, $topicId);
	}

	public function getDiscussionPosts(int $forumId, int $topicId): PostArray
	{
		return $this->valence->getDiscussionPosts($this->orgUnitId, $forumId, $topicId);
	}

	public function getDiscussionPost(int $forumId, int $topicId, int $postId): ?Post
	{
		return $this->valence->getDiscussionPost($this->orgUnitId, $forumId, $topicId, $postId);
	}

	public function getContentToc(): ?TableOfContents
	{
		return $this->valence->getContentToc($this->orgUnitId);
	}

	public function getContentTopicFile(int $topicId, string $filepath): bool
	{
		return $this->valence->getContentTopicFile($this->orgUnitId, $topicId, $filepath);
	}

	public function createCopyRequest(CreateCopyJobRequest $input): ?CreateCopyJobResponse
	{
		return $this->valence->createCourseCopyRequest($this->orgUnitId, $input);
	}

	public function getCopyJobStatus(string $jobToken): ?GetCopyJobResponse
	{
		return $this->valence->getCourseCopyJobStatus($this->orgUnitId, $jobToken);
	}

	public function getAnnouncements(): NewsItemArray
	{
		return $this->valence->getCourseAnnouncements($this->orgUnitId);
	}

	public function getDeletedAnnouncements(): NewsItemArray
	{
		return $this->valence->getDeletedCourseAnnouncements($this->orgUnitId);
	}

	public function getAnnouncementsForUser(int $userId): NewsItemArray
	{
		return $this->valence->getCourseAnnouncementsForUser($this->orgUnitId, $userId);
	}

	public function getAnnouncement(int $newsItemId): NewsItem
	{
		return $this->valence->getCourseAnnouncement($this->orgUnitId, $newsItemId);
	}

	public function postCourseAnnouncement(NewsItemData $input): NewsItem
	{
		return $this->valence->postCourseAnnouncement($this->orgUnitId, $input);
	}

	public function updateCourseAnnouncement(int $newsItemId, NewsItemData $input): void
	{
		$this->valence->updateCourseAnnouncement($this->orgUnitId, $newsItemId, $input);
	}

	public function deleteCourseAnnouncement(int $newsItemId): void
	{
		$this->valence->deleteCourseAnnouncement($this->orgUnitId, $newsItemId);
	}

	public function dismissCourseAnnouncement(int $newsItemId): void
	{
		$this->valence->dismissCourseAnnouncement($this->orgUnitId, $newsItemId);
	}

	public function publishCourseAnnouncement(int $newsItemId): void
	{
		$this->valence->publishCourseAnnouncement($this->orgUnitId, $newsItemId);
	}

	public function restoreCourseAnnouncement(int $newsItemId): void
	{
		$this->valence->restoreCourseAnnouncement($this->orgUnitId, $newsItemId);
	}

	public function restoreDeletedCourseAnnouncement(int $newsItemId): void
	{
		$this->valence->restoreDeletedCourseAnnouncement($this->orgUnitId, $newsItemId);
	}
}
