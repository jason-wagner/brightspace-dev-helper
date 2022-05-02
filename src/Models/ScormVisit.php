<?php

namespace BrightspaceDevHelper\DataHub\Model;

use Illuminate\Database\Eloquent\Model;

class ScormVisit extends Model
{
	protected $guarded = [];
	protected $table = 'ScormVisits';
	protected $primaryKey = 'VisitId';
	public $incrementing = false;
	public $timestamps = false;
}
