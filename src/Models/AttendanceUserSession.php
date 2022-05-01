<?php

namespace BrightspaceDevHelper\DataHub\Model;

use Illuminate\Database\Eloquent\Model;

class AttendanceUserSession extends Model
{
	protected $guarded = [];
	protected $table = 'AttendanceUserSessions';
	protected $primaryKey = ['UserId', 'AttendanceSessionId'];
	public $incrementing = false;
	public $timestamps = false;
}
