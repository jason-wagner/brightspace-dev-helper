<?php

namespace BrightspaceDevHelper\DataHub\Model;

use Illuminate\Database\Eloquent\Model;

class ContentUserCompletion extends Model {
	protected $guarded = [];
	protected $table = 'ContentUserCompletion';
	protected $primaryKey = ['ContentObjectId', 'UserId'];
	public $incrementing = false;
	public $timestamps = false;
}
