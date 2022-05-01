<?php

use Illuminate\Database\Eloquent\Model;

class SurveyQuestionAnswer extends Model {
	protected $guarded = [];
	protected $table = 'SurveyQuestionAnswers';
	protected $primaryKey = ['AnswerId', 'QuestionId', 'QuestionVersionId', 'SurveyObjectId'];
	public $incrementing = false;
	public $timestamps = false;
}
