<?php

namespace BrightspaceDevHelper\DataHub\Model;

use Illuminate\Database\Eloquent\Model;

class OutcomeRegistryOwner extends Model
{
	protected $guarded = [];
	protected $table = 'OutcomeRegistryOwners';
	protected $primaryKey = ['OwnerType', 'OwnerId', 'RegistryId'];
	public $incrementing = false;
	public $timestamps = false;
}
