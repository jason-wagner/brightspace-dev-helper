<?php

namespace BrightspaceDevHelper\DataHub\Model;

use Illuminate\Database\Eloquent\Model;

class AttendanceRegister extends Model
{
	protected $guarded = [];
	protected $table = 'AttendanceRegisters';
	protected $primaryKey = 'AttendanceRegisterId';
	public $incrementing = false;
	public $timestamps = false;
}
