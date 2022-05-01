<?php

namespace BrightspaceDevHelper\DataHub\Model;

use Illuminate\Database\Eloquent\Model;

class A extends Model {
	protected $guarded = [];
	protected $table = 'AwardsIssued';
	protected $primaryKey = 'IssuedId';
	public $incrementing = false;
	public $timestamps = false;
}
