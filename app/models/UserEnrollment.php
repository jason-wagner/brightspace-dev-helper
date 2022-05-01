<?php

use Illuminate\Database\Eloquent\Model;

class UserEnrollment extends Model {
	protected $guarded = [];
	protected $table = 'UserEnrollments';
	protected $primaryKey = ['OrgUnitId', 'UserId'];
	public $incrementing = false;
	public $timestamps = false;
}
