<?php

use Illuminate\Database\Eloquent\Model;

class OrganizationalUnitAncestor extends Model {
	protected $guarded = [];
	protected $table = 'OrganizationalUnitAncestors';
	protected $primaryKey = ['OrgUnitId', 'AncestorOrgUnitId'];
	public $incrementing = false;
	public $timestamps = false;
}
