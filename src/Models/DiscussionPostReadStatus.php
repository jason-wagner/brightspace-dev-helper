<?php

namespace BrightspaceDevHelper\DataHub\Model;

use Illuminate\Database\Eloquent\Model;

class DiscussionPostReadStatus extends Model
{
	protected $guarded = [];
	protected $table = 'DiscussionPostsReadStatus';
	protected $primaryKey = ['UserId', 'PostId'];
	public $incrementing = false;
	public $timestamps = false;
}
