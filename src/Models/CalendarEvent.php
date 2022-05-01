<?php

namespace BrightspaceDevHelper\DataHub\Model;

use Illuminate\Database\Eloquent\Model;

class CalendarEvent extends Model
{
	protected $guarded = [];
	protected $table = 'CalendarEvents';
	protected $primaryKey = 'ScheduleId';
	public $incrementing = false;
	public $timestamps = false;
}
