<?php

namespace BrightspaceDevHelper\DataHub\Model;

use Illuminate\Database\Eloquent\Model;

class OutcomesScaleDefinition extends Model
{
	protected $guarded = [];
	protected $table = 'OutcomesScaleDefinition';
	protected $primaryKey = 'ScaleId';
	public $incrementing = false;
	public $timestamps = false;
}
