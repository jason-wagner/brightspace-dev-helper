<?php

namespace BrightspaceDevHelper\DataHub\Model;

use Illuminate\Database\Eloquent\Model;

class AttendanceSession extends Model {
	protected $guarded = [];
	protected $table = 'AttendanceSessions';
	protected $primaryKey = 'AttendanceSessionId';
	public $incrementing = false;
	public $timestamps = false;
}
