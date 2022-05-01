<?php

use Illuminate\Database\Eloquent\Model;

class DiscussionTopic extends Model {
	protected $guarded = [];
	protected $table = 'DiscussionTopics';
	protected $primaryKey = 'TopicId';
	public $incrementing = false;
	public $timestamps = false;

	public function discussionforum() {
		return $this->belongsTo(DiscussionForum::class, 'ForumId', 'ForumId');
	}

	public function discussionposts() {
		return $this->hasMany(DiscussionPost::class, 'TopicId', 'TopicId');
	}
}
