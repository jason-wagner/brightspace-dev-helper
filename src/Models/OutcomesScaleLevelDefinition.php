<?php

namespace BrightspaceDevHelper\DataHub\Model;

use Illuminate\Database\Eloquent\Model;

class OutcomesScaleLevelDefinition extends Model
{
	protected $guarded = [];
	protected $table = 'OutcomesScaleLevelDefinition';
	protected $primaryKey = 'ScaleLevelId';
	public $incrementing = false;
	public $timestamps = false;
}
