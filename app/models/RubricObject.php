<?php

use Illuminate\Database\Eloquent\Model;

class RubricObject extends Model {
	protected $guarded = [];
	protected $table = 'RubricObjects';
	protected $primaryKey = 'RubricId';
	public $incrementing = false;
	public $timestamps = false;
}
