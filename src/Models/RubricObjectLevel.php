<?php

namespace BrightspaceDevHelper\DataHub\Model;

use Illuminate\Database\Eloquent\Model;

class RubricObjectLevel extends Model {
	protected $guarded = [];
	protected $table = 'RubricObjectLevels';
	protected $primaryKey = ['RubricId', 'LevelId'];
	public $incrementing = false;
	public $timestamps = false;
}
