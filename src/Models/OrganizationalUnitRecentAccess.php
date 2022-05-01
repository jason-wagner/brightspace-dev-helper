<?php

namespace BrightspaceDevHelper\DataHub\Model;

use Illuminate\Database\Eloquent\Model;

class OrganizationalUnitRecentAccess extends Model
{
	protected $guarded = [];
	protected $table = 'OrganizationalUnitRecentAccess';
	protected $primaryKey = ['OrgUnitId', 'UserId'];
	public $incrementing = false;
	public $timestamps = false;
}
