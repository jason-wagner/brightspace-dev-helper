<?php

namespace BrightspaceDevHelper\DataHub\Model;

use Illuminate\Database\Eloquent\Model;

class AwardObject extends Model
{
	protected $guarded = [];
	protected $table = 'AwardObjects';
	protected $primaryKey = 'AwardId';
	public $incrementing = false;
	public $timestamps = false;
}
