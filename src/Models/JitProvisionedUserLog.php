<?php

namespace BrightspaceDevHelper\DataHub\Model;

use Illuminate\Database\Eloquent\Model;

class JitProvisionedUserLog extends Model
{
	protected $guarded = [];
	protected $table = 'JitProvisionedUsersLog';
	protected $primaryKey = ['UserId', 'Timestamp'];
	public $incrementing = false;
	public $timestamps = false;
}
