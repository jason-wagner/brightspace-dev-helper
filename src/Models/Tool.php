<?php

namespace BrightspaceDevHelper\DataHub\Model;

use Illuminate\Database\Eloquent\Model;

class Tool extends Model
{
	protected $guarded = [];
	protected $table = 'Tools';
	protected $primaryKey = 'ToolId';
	public $incrementing = false;
	public $timestamps = false;
}
