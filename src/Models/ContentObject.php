<?php

namespace BrightspaceDevHelper\DataHub\Model;

use Illuminate\Database\Eloquent\Model;

class ContentObject extends Model
{
	protected $guarded = [];
	protected $table = 'ContentObjects';
	protected $primaryKey = 'ContentObjectId';
	public $incrementing = false;
	public $timestamps = false;
}
