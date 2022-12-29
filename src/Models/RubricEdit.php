<?php

namespace BrightspaceDevHelper\DataHub\Model;

use Illuminate\Database\Eloquent\Model;

class RubricEdit extends Model
{
	protected $guarded = [];
	protected $table = 'RubricsEdit';
	protected $primaryKey = 'AuditLogId';
	public $incrementing = false;
	public $timestamps = false;
}
