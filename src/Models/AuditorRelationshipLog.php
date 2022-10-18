<?php

namespace BrightspaceDevHelper\DataHub\Model;

use Illuminate\Database\Eloquent\Model;

class AuditorRelationshipLog extends Model
{
	protected $guarded = [];
	protected $table = 'AuditorRelationshipsLog';
	protected $primaryKey = ['AuditorId', 'UserToAuditId', 'OrgUnitId', 'ModifiedDate'];
	public $incrementing = false;
	public $timestamps = false;
}
