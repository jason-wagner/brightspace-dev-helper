<?php

use Illuminate\Database\Eloquent\Model;

class QuestionLibrary extends Model {
	protected $guarded = [];
	protected $table = 'QuestionLibrary';
	protected $primaryKey = ['QuestionId', 'QuestionVersionId'];
	public $incrementing = false;
	public $timestamps = false;
}
