<?php

namespace BrightspaceDevHelper\DataHub\Model;

use Illuminate\Database\Eloquent\Model;

class ContentUserProgress extends Model
{
	protected $guarded = [];
	protected $table = 'ContentUserProgress';
	protected $primaryKey = ['ContentObjectId', 'UserId'];
	public $incrementing = false;
	public $timestamps = false;
}
