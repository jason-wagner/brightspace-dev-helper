<?php

namespace BrightspaceDevHelper\DataHub\Model;

use Illuminate\Database\Eloquent\Model;

class AssignmentSubmission extends Model
{
	protected $guarded = [];
	protected $table = 'AssignmentSubmissions';
	protected $primaryKey = ['DropboxId', 'SubmitterId'];
	public $incrementing = false;
	public $timestamps = false;

	public function users()
	{
		return $this->belongsTo(User::class, 'OrgUnitId', 'OrgUnitId');
	}

	public function assignmentsummary()
	{
		return $this->belongsTo(AssignmentSummary::class, 'DropboxId', 'DropboxId');
	}
}
