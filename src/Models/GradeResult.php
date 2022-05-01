<?php

namespace BrightspaceDevHelper\DataHub\Model;

use Illuminate\Database\Eloquent\Model;

class GradeResult extends Model
{
	protected $guarded = [];
	protected $table = 'GradeResults';
	protected $primaryKey = ['GradeObjectId', 'OrgUnitId', 'UserId'];
	public $incrementing = false;
	public $timestamps = false;
}
