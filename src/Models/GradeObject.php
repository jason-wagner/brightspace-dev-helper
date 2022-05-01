<?php

namespace BrightspaceDevHelper\DataHub\Model;

use Illuminate\Database\Eloquent\Model;

class GradeObject extends Model {
	protected $guarded = [];
	protected $table = 'GradeObjects';
	protected $primaryKey = 'GradeObjectId';
	public $incrementing = false;
	public $timestamps = false;
}
