<?php

namespace BrightspaceDevHelper\DataHub\Model;

use Illuminate\Database\Eloquent\Model;

class ActivityFeedCommentObject extends Model {
	protected $guarded = [];
	protected $table = 'ActivityFeedCommentObjects';
	protected $primaryKey = 'CommentId';
	public $incrementing = false;
	public $timestamps = false;
}
