<?php

namespace BrightspaceDevHelper\DataHub\Model;

use Illuminate\Database\Eloquent\Model;

class CourseAccess extends Model {
	protected $guarded = [];
	protected $table = 'CourseAccess';
	protected $primaryKey = ['OrgUnitId', 'UserId', 'DayAccessed'];
	public $incrementing = false;
	public $timestamps = false;
}
