<?php

use Illuminate\Database\Eloquent\Model;

class CompetencyObject extends Model {
	protected $guarded = [];
	protected $table = 'CompetencyObjects';
	protected $primaryKey = 'ObjectId';
	public $incrementing = false;
	public $timestamps = false;
}
