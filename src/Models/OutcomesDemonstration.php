<?php

namespace BrightspaceDevHelper\DataHub\Model;

use Illuminate\Database\Eloquent\Model;

class OutcomesDemonstration extends Model
{
	protected $guarded = [];
	protected $table = 'OutcomesDemonstrations';
	protected $primaryKey = 'DemonstrationId';
	public $incrementing = false;
	public $timestamps = false;
}
