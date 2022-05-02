<?php

namespace BrightspaceDevHelper\DataHub\Model;

use Illuminate\Database\Eloquent\Model;

class QuizQuestionAnswerOption extends Model
{
	protected $guarded = [];
	protected $table = 'QuizQuestionAnswerOptions';
	protected $primaryKey = ['AnswerId', 'QuestionId', 'QuestionVersionId', 'QuizObjectId', 'AnswerOptionId'];
	public $incrementing = false;
	public $timestamps = false;
}
