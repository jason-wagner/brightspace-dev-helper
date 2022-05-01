<?php

namespace BrightspaceDevHelper\DataHub\Model;

use Illuminate\Database\Eloquent\Model;

class CompetencyLog extends Model {
	protected $guarded = [];
	protected $table = 'CompetencyLog';
	protected $primaryKey = 'CompetencyLogId';
	public $incrementing = false;
	public $timestamps = false;
}
