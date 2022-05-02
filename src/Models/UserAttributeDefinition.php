<?php

namespace BrightspaceDevHelper\DataHub\Model;

use Illuminate\Database\Eloquent\Model;

class UserAttributeDefinition extends Model
{
	protected $guarded = [];
	protected $table = 'UserAttributeDefinitions';
	protected $primaryKey = 'AttributeId';
	public $incrementing = false;
	public $timestamps = false;
}
