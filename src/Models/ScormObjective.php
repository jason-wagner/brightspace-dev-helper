<?php

namespace BrightspaceDevHelper\DataHub\Model;

use Illuminate\Database\Eloquent\Model;

class ScormObjective extends Model
{
	protected $guarded = [];
	protected $table = 'ScormObjectives';
	protected $primaryKey = 'ObjectiveId';
	public $incrementing = false;
	public $timestamps = false;
}
