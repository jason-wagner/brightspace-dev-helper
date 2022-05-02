<?php

namespace BrightspaceDevHelper\DataHub\Model;

use Illuminate\Database\Eloquent\Model;

class LtiLaunch extends Model
{
	protected $guarded = [];
	protected $table = 'LtiLaunches';
	protected $primaryKey = 'LTILaunchId';
	public $incrementing = false;
	public $timestamps = false;
}
