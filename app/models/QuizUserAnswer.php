<?php

use Illuminate\Database\Eloquent\Model;

class QuizUserAnswer extends Model {
	protected $guarded = [];
	protected $table = 'QuizUserAnswers';
	protected $primaryKey = ['AttemptId', 'QuestionId', 'QuestionVersionId'];
	public $incrementing = false;
	public $timestamps = false;
}
