<?php

namespace BrightspaceDevHelper\DataHub\Model;

use Illuminate\Database\Eloquent\Model;

class ScormObject extends Model
{
	protected $guarded = [];
	protected $table = 'ScormObjects';
	protected $primaryKey = 'ScormObjectId';
	public $incrementing = false;
	public $timestamps = false;
}
