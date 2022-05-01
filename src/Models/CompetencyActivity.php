<?php

namespace BrightspaceDevHelper\DataHub\Model;

use Illuminate\Database\Eloquent\Model;

class CompetencyActivity extends Model {
	protected $guarded = [];
	protected $table = 'CompetencyActivities';
	protected $primaryKey = 'ActivityId';
	public $incrementing = false;
	public $timestamps = false;
}
