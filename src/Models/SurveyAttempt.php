<?php

namespace BrightspaceDevHelper\DataHub\Model;

use Illuminate\Database\Eloquent\Model;

class SurveyAttempt extends Model {
	protected $guarded = [];
	protected $table = 'SurveyAttempts';
	protected $primaryKey = 'AttemptId';
	public $incrementing = false;
	public $timestamps = false;
}
