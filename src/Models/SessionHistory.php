<?php

namespace BrightspaceDevHelper\DataHub\Model;

use Illuminate\Database\Eloquent\Model;

class SessionHistory extends Model
{
	protected $guarded = [];
	protected $table = 'SessionHistory';
	protected $primaryKey = 'HistoryId';
	public $incrementing = false;
	public $timestamps = false;
}
