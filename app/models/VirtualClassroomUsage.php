<?php

use Illuminate\Database\Eloquent\Model;

class VirtualClassroomUsage extends Model {
	protected $guarded = [];
	protected $table = 'VirtualClassroomUsage';
	protected $primaryKey = 'MeetingId';
	public $incrementing = false;
	public $timestamps = false;
}
