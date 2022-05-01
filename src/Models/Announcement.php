<?php

namespace BrightspaceDevHelper\DataHub\Model;

use Illuminate\Database\Eloquent\Model;

class Announcement extends Model {
	protected $guarded = [];
	protected $table = 'Announcements';
	protected $primaryKey = 'AnnouncementId';
	public $incrementing = false;
	public $timestamps = false;
}
