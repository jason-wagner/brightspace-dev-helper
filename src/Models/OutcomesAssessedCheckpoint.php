<?php

namespace BrightspaceDevHelper\DataHub\Model;

use Illuminate\Database\Eloquent\Model;

class OutcomesAssessedCheckpoint extends Model
{
	protected $guarded = [];
	protected $table = 'OutcomesAssessedCheckpoints';
	protected $primaryKey = ['CheckpointId', 'DemonstrationId'];
	public $incrementing = false;
	public $timestamps = false;
}
