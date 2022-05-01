<?php

use Illuminate\Database\Eloquent\Model;

class PreRequisiteConditionsMet extends Model {
	protected $guarded = [];
	protected $table = 'PreRequisiteConditionsMet';
	protected $primaryKey = ['PreRequisiteId', 'UserId'];
	public $incrementing = false;
	public $timestamps = false;
}
