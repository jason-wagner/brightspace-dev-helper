<?php

namespace BrightspaceDevHelper\DataHub\Model;

use Illuminate\Database\Eloquent\Model;

class SurveyQuestionAnswerOption extends Model
{
	protected $guarded = [];
	protected $table = 'SurveyQuestionAnswerOptions';
	protected $primaryKey = ['SurveyObjectId', 'QuestionId', 'QuestionVersionId', 'AnswerId', 'AnswerOptionId'];
	public $incrementing = false;
	public $timestamps = false;
}
