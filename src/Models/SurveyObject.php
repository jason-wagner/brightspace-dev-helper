<?php

namespace BrightspaceDevHelper\DataHub\Model;

use Illuminate\Database\Eloquent\Model;

class SurveyObject extends Model {
	protected $guarded = [];
	protected $table = 'SurveyObjects';
	protected $primaryKey = ['SurveyId', 'OrgUnitId'];
	public $incrementing = false;
	public $timestamps = false;
}
