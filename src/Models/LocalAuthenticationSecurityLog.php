<?php

namespace BrightspaceDevHelper\DataHub\Model;

use Illuminate\Database\Eloquent\Model;

class LocalAuthenticationSecurityLog extends Model
{
	protected $guarded = [];
	protected $table = 'LocalAuthenticationSecurityLog';
	protected $primaryKey = ['UserId', 'Action', 'ModifiedBy', 'ModifiedDate'];
	public $incrementing = false;
	public $timestamps = false;
}
