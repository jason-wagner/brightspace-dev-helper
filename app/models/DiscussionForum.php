<?php

use Illuminate\Database\Eloquent\Model;

class DiscussionForum extends Model {
	protected $guarded = [];
	protected $table = 'DiscussionForums';
	protected $primaryKey = 'ForumId';
	public $incrementing = false;
	public $timestamps = false;

	public function orgunit() {
		return $this->belongsTo(OrganizationalUnit::class, 'OrgUnitId', 'OrgUnitId');
	}

	public function discussiontopics() {
		return $this->hasMany(DiscussionTopic::class, 'ForumId', 'ForumId');
	}
}
