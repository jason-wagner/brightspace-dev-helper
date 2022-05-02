<?php

namespace BrightspaceDevHelper\DataHub\Model;

use Illuminate\Database\Eloquent\Model;

class AccommodationProfileLog extends Model
{
	protected $guarded = [];
	protected $table = 'AccommodationsProfileLog';
	protected $primaryKey = ['AccommodatedUserId', 'OrgUnitId', 'LastModified'];
	public $incrementing = false;
	public $timestamps = false;
}
