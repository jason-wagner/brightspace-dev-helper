<?php

namespace BrightspaceDevHelper\DataHub\Model;

use Illuminate\Database\Eloquent\Model;

class AssignmentSubmissionDetail extends Model {
	protected $guarded = [];
	protected $table = 'AssignmentSubmissionDetails';
	protected $primaryKey = 'SubmissionId';
	public $incrementing = false;
	public $timestamps = false;
}
