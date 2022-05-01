<?php

namespace BrightspaceDevHelper\DataHub\Model;

use Illuminate\Database\Eloquent\Model;

class AttendanceScheme extends Model {
	protected $guarded = [];
	protected $table = 'AttendanceSchemes';
	protected $primaryKey = ['SchemeId', 'SchemeSymbolId'];
	public $incrementing = false;
	public $timestamps = false;
}
