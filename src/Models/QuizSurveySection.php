<?php

namespace BrightspaceDevHelper\DataHub\Model;

use Illuminate\Database\Eloquent\Model;

class QuizSurveySection extends Model {
	protected $guarded = [];
	protected $table = 'QuizSurveySections';
	protected $primaryKey = 'SectionId';
	public $incrementing = false;
	public $timestamps = false;
}
