<?php

namespace BrightspaceDevHelper\DataHub\Model;

use Illuminate\Database\Eloquent\Model;

class User extends Model
{
	protected $guarded = [];
	protected $table = 'Users';
	protected $primaryKey = 'UserId';
	public $incrementing = false;
	public $timestamps = false;

	public static function whereUserName($username)
	{
		return User::where('UserName', $username)->first();
	}

	public static function whereOrgDefinedId($orgdefinedid)
	{
		return User::where('OrgDefinedId', $orgdefinedid)->first();
	}

	public function courses()
	{
		return $this->belongsToMany(OrganizationalUnit::class, 'UserEnrollments', 'UserId', 'OrgUnitId')->where('Type', 'Course Offering');
	}

	public function discussionposts()
	{
		return $this->hasMany(DiscussionPost::class, 'UserId', 'UserId');
	}

	public function assignmentsubmissions()
	{
		return $this->hasMany(AssignmentSubmission::class, 'SubmitterId', 'UserId');
	}

	public function quizattempts()
	{
		return $this->hasMany(QuizAttempt::class, 'UserId', 'UserId');
	}
}
