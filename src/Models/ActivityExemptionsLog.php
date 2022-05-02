<?php

namespace BrightspaceDevHelper\DataHub\Model;

use Illuminate\Database\Eloquent\Model;

class ActivityExemptionsLog extends Model
{
	protected $guarded = [];
	protected $table = 'ActivityExemptionsLog';
	protected $primaryKey = 'ActivityExemptionsLogId';
	public $incrementing = false;
	public $timestamps = false;
}
