<?php

namespace BrightspaceDevHelper\DataHub\Model;

use Illuminate\Database\Eloquent\Model;

class OrganizationalUnit extends Model
{
	protected $guarded = [];
	protected $table = 'OrganizationalUnits';
	protected $primaryKey = 'OrgUnitId';
	public $incrementing = false;
	public $timestamps = false;

	public static function whereCode($code)
	{
		return OrganizationalUnit::where('Code', $code)->where('Type', 'Course Offering')->first();
	}

	public static function whereCodeAndType($code, $type)
	{
		return OrganizationalUnit::where('Code', $code)->where('OrgUnitTypeId', $type)->first();
	}

	public function assignments()
	{
		return $this->hasMany(AssignmentSummary::class, 'OrgUnitId', 'OrgUnitId');
	}

	public function discussionforums()
	{
		return $this->hasMany(DiscussionForum::class, 'OrgUnitId', 'OrgUnitId');
	}

	public function quizobjects()
	{
		return $this->hasMany(QuizObject::class, 'OrgUnitId', 'OrgUnitId');
	}

	public function users()
	{
		return $this->belongsToMany(Users::class, 'UserEnrollments', 'OrgUnitId', 'UserId');
	}
}
