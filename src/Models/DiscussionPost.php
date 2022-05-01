<?php

namespace BrightspaceDevHelper\DataHub\Model;

use Illuminate\Database\Eloquent\Model;

class DiscussionPost extends Model
{
	protected $guarded = [];
	protected $table = 'DiscussionPosts';
	protected $primaryKey = 'PostId';
	public $incrementing = false;
	public $timestamps = false;

	public function users()
	{
		return $this->belongsTo(User::class, 'OrgUnitId', 'OrgUnitId');
	}

	public function discussiontopic()
	{
		return $this->belongsTo(DiscussionTopic::class, 'TopicId', 'TopicId');
	}
}
