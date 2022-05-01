<?php

namespace BrightspaceDevHelper\DataHub\Model;

use Illuminate\Database\Eloquent\Model;

class RubricAssessment extends Model
{
	protected $guarded = [];
	protected $table = 'RubricAssessments';
	protected $primaryKey = ['UserId', 'AssessmentId'];
	public $incrementing = false;
	public $timestamps = false;
}
