<?php

namespace BrightspaceDevHelper\DataHub\Model;

use Illuminate\Database\Eloquent\Model;

class UserLogin extends Model {
	protected $guarded = [];
	protected $table = 'UserLogins';
	protected $primaryKey = 'LoginAttemptId';
	public $incrementing = false;
	public $timestamps = false;
}
