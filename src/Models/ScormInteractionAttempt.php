<?php

namespace BrightspaceDevHelper\DataHub\Model;

use Illuminate\Database\Eloquent\Model;

class ScormInteractionAttempt extends Model
{
	protected $guarded = [];
	protected $table = 'ScormInteractionAttempts';
	protected $primaryKey = ['VisitId', 'InteractionId', 'AttemptNumber'];
	public $incrementing = false;
	public $timestamps = false;
}
