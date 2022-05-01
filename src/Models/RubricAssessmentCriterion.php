<?php

namespace BrightspaceDevHelper\DataHub\Model;

use Illuminate\Database\Eloquent\Model;

class RubricAssessmentCriterion extends Model {
	protected $guarded = [];
	protected $table = 'RubricAssessmentCriteria';
	protected $primaryKey = ['AssessmentId', 'UserId', 'RubricId', 'CriterionId'];
	public $incrementing = false;
	public $timestamps = false;
}
