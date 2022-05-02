<?php

namespace BrightspaceDevHelper\DataHub\Model;

use Illuminate\Database\Eloquent\Model;

class AssignmentSpecialAccess extends Model
{
	protected $guarded = [];
	protected $table = 'AssignmentSpecialAccess';
	protected $primaryKey = ['DropboxId', 'UserId'];
	public $incrementing = false;
	public $timestamps = false;
}
