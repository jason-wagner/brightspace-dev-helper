<?php

use Illuminate\Database\Eloquent\Model;

class CompetencyActivityResult extends Model {
	protected $guarded = [];
	protected $table = 'CompetencyActivityResults';
	protected $primaryKey = ['ActivityId', 'OrgUnitId', 'UserId', 'LearningObjectId'];
	public $incrementing = false;
	public $timestamps = false;
}
