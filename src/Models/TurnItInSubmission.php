<?php

namespace BrightspaceDevHelper\DataHub\Model;

use Illuminate\Database\Eloquent\Model;

class TurnItInSubmission extends Model {
	protected $guarded = [];
	protected $table = 'TurnItInSubmissions';
	protected $primaryKey = ['DropboxId', 'SubmissionId', 'FileId'];
	public $incrementing = false;
	public $timestamps = false;
}
