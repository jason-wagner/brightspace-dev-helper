<?php

namespace BrightspaceDevHelper\DataHub\Model;

use Illuminate\Database\Eloquent\Model;

class QuizObject extends Model
{
	protected $guarded = [];
	protected $table = 'QuizObjects';
	protected $primaryKey = ['QuizId', 'OrgUnitId'];
	public $incrementing = false;
	public $timestamps = false;

	public function orgunit()
	{
		return $this->belongsTo(OrganizationalUnit::class, 'OrgUnitId', 'OrgUnitId');
	}

	public function quizattempts()
	{
		return $this->hasMany(QuizAttempt::class, 'QuizId', 'QuizId');
	}
}
