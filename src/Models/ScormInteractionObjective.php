<?php

namespace BrightspaceDevHelper\DataHub\Model;

use Illuminate\Database\Eloquent\Model;

class ScormInteractionObjective extends Model
{
	protected $guarded = [];
	protected $table = 'ScormInteractionObjectives';
	protected $primaryKey = ['InteractionId', 'ObjectiveId'];
	public $incrementing = false;
	public $timestamps = false;
}
