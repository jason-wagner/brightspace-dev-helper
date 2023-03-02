<?php

namespace BrightspaceDevHelper\DataHub\Model;

use Illuminate\Database\Eloquent\Model;

class LtiLinkMigrationAudit extends Model
{
	protected $guarded = [];
	protected $table = 'LtiLinkMigrationAudit';
	protected $primaryKey = 'LtiMigrationId';
	public $incrementing = false;
	public $timestamps = false;
}
