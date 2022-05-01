<?php

namespace BrightspaceDevHelper\DataHub\Model;

use Illuminate\Database\Eloquent\Model;

class QuizUserAnswerResponse extends Model {
	protected $guarded = [];
	protected $table = 'QuizUserAnswerResponses';
	protected $primaryKey = ['AttemptId', 'QuestionId', 'QuestionVersionId', 'AnswerId'];
	public $incrementing = false;
	public $timestamps = false;
}
