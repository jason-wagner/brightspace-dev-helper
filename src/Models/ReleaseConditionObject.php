<?php

namespace BrightspaceDevHelper\DataHub\Model;

use Illuminate\Database\Eloquent\Model;

class ReleaseConditionObject extends Model
{
	protected $guarded = [];
	protected $table = 'ReleaseConditionObjects';
	protected $primaryKey = ['PreRequisiteId', 'ResultId'];
	public $incrementing = false;
	public $timestamps = false;
}
