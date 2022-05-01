<?php

namespace BrightspaceDevHelper\DataHub\Model;

use Illuminate\Database\Eloquent\Model;

class QuizQuestionAnswer extends Model
{
	protected $guarded = [];
	protected $table = 'QuizQuestionAnswers';
	protected $primaryKey = ['QuestionId', 'QuestionVersionId', 'AnswerId', 'ObjectId'];
	public $incrementing = false;
	public $timestamps = false;
}
