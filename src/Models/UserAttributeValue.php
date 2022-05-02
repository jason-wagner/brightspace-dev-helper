<?php

namespace BrightspaceDevHelper\DataHub\Model;

use Illuminate\Database\Eloquent\Model;

class UserAttributeValue extends Model
{
	protected $guarded = [];
	protected $table = 'UserAttributeValues';
	protected $primaryKey = ['UserId', 'AttributeId'];
	public $incrementing = false;
	public $timestamps = false;
}
