<?php

use Illuminate\Database\Eloquent\Model;

class DiscussionTopicUserScore extends Model {
	protected $guarded = [];
	protected $table = 'DiscussionTopicUserScores';
	protected $primaryKey = ['UserId', 'TopicId'];
	public $incrementing = false;
	public $timestamps = false;
}
