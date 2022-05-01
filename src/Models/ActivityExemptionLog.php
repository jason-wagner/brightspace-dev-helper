<?php

namespace BrightspaceDevHelper\DataHub\Model;

use Illuminate\Database\Eloquent\Model;

class ActivityExemptionLog extends Model
{
	protected $guarded = [];
	protected $table = 'ActivityExemptionsLog';
	protected $primaryKey = 'ActivityExemptionsLogId';
	public $incrementing = false;
	public $timestamps = false;
}
