<?php

namespace BrightspaceDevHelper\DataHub\Model;

use Illuminate\Database\Eloquent\Model;

class SurveyUserAnswer extends Model {
	protected $guarded = [];
	protected $table = 'SurveyUserAnswers';
	protected $primaryKey = ['AttemptId', 'QuestionId', 'QuestionVersionId'];
	public $incrementing = false;
	public $timestamps = false;
}
