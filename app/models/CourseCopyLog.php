<?php

use Illuminate\Database\Eloquent\Model;

class CourseCopyLog extends Model {
	protected $guarded = [];
	protected $table = 'CourseCopyLogs';
	protected $primaryKey = 'CopyCourseJobId';
	public $incrementing = false;
	public $timestamps = false;
}
