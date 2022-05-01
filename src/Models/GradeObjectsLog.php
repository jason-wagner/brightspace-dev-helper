<?php

namespace BrightspaceDevHelper\DataHub\Model;

use Illuminate\Database\Eloquent\Model;

class GradeObjectsLog extends Model {
	protected $guarded = [];
	protected $table = 'GradeObjectsLog';
	protected $primaryKey = 'LogId';
	public $incrementing = false;
	public $timestamps = false;
}
