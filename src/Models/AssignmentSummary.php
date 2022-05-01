<?php

namespace BrightspaceDevHelper\DataHub\Model;

use Illuminate\Database\Eloquent\Model;

class AssignmentSummary extends Model
{
	protected $guarded = [];
	protected $table = 'AssignmentSummary';
	protected $primaryKey = 'DropboxId';
	public $incrementing = false;
	public $timestamps = false;

	public function orgunit()
	{
		return $this->belongsTo(OrganizationalUnit::class, 'OrgUnitId', 'OrgUnitId');
	}

	public function assignmentsubmissions()
	{
		return $this->hasMany(AssignmentSubmission::class, 'DropboxId', 'DropboxId');
	}
}
