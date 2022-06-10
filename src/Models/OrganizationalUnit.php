<?php

namespace BrightspaceDevHelper\DataHub\Model;

use Carbon\Carbon;
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
		return OrganizationalUnit::where('Code', $code)->where('Type', 'Course Offering');
	}

	public static function whereCodeAndType($code, $type)
	{
		return OrganizationalUnit::where('Code', $code)->where('OrgUnitTypeId', $type);
	}

	public static function whereOrgUnitId($orgUnitId)
	{
		return OrganizationalUnit::where('OrgUnitId', $orgUnitId);
	}

	public static function isCurrent(int $orgUnitId, int $thresholdInDays): bool
	{
		return (bool)OrganizationalUnit::where('OrgUnitId', $orgUnitId)->whereDate('EndDate', '<', Carbon::now('UTC')->subDays($thresholdInDays))->first();
	}

	public function getParents()
	{
		return $this->belongsToMany(OrganizationalUnit::class, 'OrganizationalUnitAncestors', 'OrgUnitId', 'AncestorOrgUnitId');
	}

	public function semester()
	{
		return $this->getParents()->where('Type', 'Semester');
	}

	public function template()
	{
		return $this->getParents()->where('Type', 'Course Template');
	}

	public function department()
	{
		return $this->getParents()->where('Type', 'Department');
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
