<?php

namespace BrightspaceDevHelper\DataHub\Model;

use Illuminate\Database\Eloquent\Model;

class SurveyUserAnswerResponse extends Model
{
	protected $guarded = [];
	protected $table = 'SurveyUserAnswerResponses';
	protected $primaryKey = ['AttemptId', 'QuestionId', 'QuestionVersionId', 'AnswerId'];
	public $incrementing = false;
	public $timestamps = false;
}
