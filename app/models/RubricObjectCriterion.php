<?php

use Illuminate\Database\Eloquent\Model;

class RubricObjectCriterion extends Model {
	protected $guarded = [];
	protected $table = 'RubricObjectCriteria';
	protected $primaryKey = ['RubricId', 'CriterionId'];
	public $incrementing = false;
	public $timestamps = false;
}
