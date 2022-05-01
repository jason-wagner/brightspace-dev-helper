<?php

namespace BrightspaceDevHelper\DataHub\Model;

use Illuminate\Database\Eloquent\Model;

class ActivityFeedPostLog extends Model {
	protected $guarded = [];
	protected $table = 'ActivityFeedPostLog';
	protected $primaryKey = 'LogId';
	public $incrementing = false;
	public $timestamps = false;
}
