<?php

namespace BrightspaceDevHelper\DataHub\Model;

use Illuminate\Database\Eloquent\Model;

class OrganizationalUnitParent extends Model {
	protected $guarded = [];
	protected $table = 'OrganizationalUnitParents';
	protected $primaryKey = ['OrgUnitId', 'ParentOrgUnitId'];
	public $incrementing = false;
	public $timestamps = false;
}
