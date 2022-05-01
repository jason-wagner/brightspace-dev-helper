<?php

namespace BrightspaceDevHelper\DataHub\Model;

use Illuminate\Database\Eloquent\Model;

class OrganizationalUnitDescendant extends Model
{
	protected $guarded = [];
	protected $table = 'OrganizationalUnitDescendants';
	protected $primaryKey = ['OrgUnitId', 'DescendantOrgUnitId'];
	public $incrementing = false;
	public $timestamps = false;
}
