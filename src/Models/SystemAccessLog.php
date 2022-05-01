<?php

namespace BrightspaceDevHelper\DataHub\Model;

use Illuminate\Database\Eloquent\Model;

class SystemAccessLog extends Model
{
	protected $guarded = [];
	protected $table = 'SystemAccessLog';
	protected $primaryKey = ['SessionId', 'UserId', 'Timestamp', 'State'];
	public $incrementing = false;
	public $timestamps = false;
}
