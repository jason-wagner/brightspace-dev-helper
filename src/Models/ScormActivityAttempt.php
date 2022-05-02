<?php

namespace BrightspaceDevHelper\DataHub\Model;

use Illuminate\Database\Eloquent\Model;

class ScormActivityAttempt extends Model
{
	protected $guarded = [];
	protected $table = 'ScormActivityAttempts';
	protected $primaryKey = ['VisitId', 'ActivityId', 'AttemptNumber'];
	public $incrementing = false;
	public $timestamps = false;
}
