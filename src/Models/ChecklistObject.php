<?php

namespace BrightspaceDevHelper\DataHub\Model;

use Illuminate\Database\Eloquent\Model;

class ChecklistObject extends Model {
	protected $guarded = [];
	protected $table = 'ChecklistObjects';
	protected $primaryKey = 'ChecklistId';
	public $incrementing = false;
	public $timestamps = false;
}
