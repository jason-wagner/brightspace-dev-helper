<?php

namespace BrightspaceDevHelper\DataHub\Model;

use Illuminate\Database\Eloquent\Model;

class LtiLinksShared extends Model {
	protected $guarded = [];
	protected $table = 'LtiLinksShared';
	protected $primaryKey = ['OuAvailabilitySetId', 'OrgUnitId'];
	public $incrementing = false;
	public $timestamps = false;
}
