<?php

use Illuminate\Database\Eloquent\Model;

class ActivityFeedPostObject extends Model {
	protected $guarded = [];
	protected $table = 'ActivityFeedPostObjects';
	protected $primaryKey = 'PostId';
	public $incrementing = false;
	public $timestamps = false;
}
