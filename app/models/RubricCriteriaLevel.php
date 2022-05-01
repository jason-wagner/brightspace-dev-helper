<?php

use Illuminate\Database\Eloquent\Model;

class RubricCriteriaLevel extends Model {
	protected $guarded = [];
	protected $table = 'RubricCriteriaLevels';
	protected $primaryKey = ['RubricId', 'LevelId', 'CriterionId'];
	public $incrementing = false;
	public $timestamps = false;
}
