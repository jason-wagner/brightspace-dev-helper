<?php

use Illuminate\Database\Eloquent\Model;

class QuizAttempt extends Model {
	protected $guarded = [];
	protected $table = 'QuizAttempts';
	protected $primaryKey = 'AttemptId';
	public $incrementing = false;
	public $timestamps = false;

	public function user() {
		return $this->belongsTo(User::class, 'UserId', 'UserId');
	}

	public function quizobject() {
		return $this->belongsTo(QuizObject::class, 'QuizId', 'QuizId');
	}
}
