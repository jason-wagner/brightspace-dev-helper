<?php

use Illuminate\Database\Eloquent\Model;

class EnrollmentAndWithdrawal extends Model {
	protected $guarded = [];
	protected $table = 'EnrollmentsAndWithdrawals';
	protected $primaryKey = 'LogId';
	public $incrementing = false;
	public $timestamps = false;
}
