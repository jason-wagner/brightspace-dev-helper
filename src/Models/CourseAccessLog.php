<?php

namespace BrightspaceDevHelper\DataHub\Model;

use Illuminate\Database\Eloquent\Model;

class CourseAccessLog extends Model
{
	protected $guarded = [];
	protected $table = 'CourseAccessLog';
	protected $primaryKey = ['OrgUnitId', 'UserId', 'Timestamp', 'Source'];
	public $incrementing = false;
	public $timestamps = false;
}
