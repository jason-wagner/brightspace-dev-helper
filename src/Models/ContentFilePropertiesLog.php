<?php

namespace BrightspaceDevHelper\DataHub\Model;

use Illuminate\Database\Eloquent\Model;

class ContentFilePropertiesLog extends Model
{
	protected $guarded = [];
	protected $table = 'ContentFilesPropertiesLog';
	protected $primaryKey = ['OrgUnitId', 'ContentObjectId', 'LastModified'];
	public $incrementing = false;
	public $timestamps = false;
}
