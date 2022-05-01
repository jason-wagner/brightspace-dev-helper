<?php

namespace BrightspaceDevHelper\DataHub\Model;

use Illuminate\Database\Eloquent\Model;

class ChecklistCompletion extends Model
{
	protected $guarded = [];
	protected $table = 'ChecklistCompletions';
	protected $primaryKey = ['ItemId', 'UserId'];
	public $incrementing = false;
	public $timestamps = false;
}
