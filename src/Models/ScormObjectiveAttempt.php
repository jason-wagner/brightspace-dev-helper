<?php

namespace BrightspaceDevHelper\DataHub\Model;

use Illuminate\Database\Eloquent\Model;

class ScormObjectiveAttempt extends Model
{
	protected $guarded = [];
	protected $table = 'ScormObjectiveAttempts';
	protected $primaryKey = ['VisitId', 'ObjectiveId', 'AttemptNumber'];
	public $incrementing = false;
	public $timestamps = false;
}
