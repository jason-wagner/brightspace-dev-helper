<?php

namespace BrightspaceDevHelper\DataHub\Model;

use Illuminate\Database\Eloquent\Model;

class ReleaseConditionResult extends Model
{
	protected $guarded = [];
	protected $table = 'ReleaseConditionResults';
	protected $primaryKey = ['ResultId', 'UserId'];
	public $incrementing = false;
	public $timestamps = false;
}
