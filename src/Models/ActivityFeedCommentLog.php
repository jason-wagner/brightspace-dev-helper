<?php

namespace BrightspaceDevHelper\DataHub\Model;

use Illuminate\Database\Eloquent\Model;

class ActivityFeedCommentLog extends Model {
	protected $guarded = [];
	protected $table = 'ActivityFeedCommentLog';
	protected $primaryKey = 'LogId';
	public $incrementing = false;
	public $timestamps = false;
}
