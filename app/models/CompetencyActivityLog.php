<?php

use Illuminate\Database\Eloquent\Model;

class CompetencyActivityLog extends Model {
	protected $guarded = [];
	protected $table = 'CompetencyActivityLog';
	protected $primaryKey = ['ActivityLogId', 'ActivityId'];
	public $incrementing = false;
	public $timestamps = false;
}
