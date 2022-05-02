<?php

namespace BrightspaceDevHelper\DataHub\Model;

use Illuminate\Database\Eloquent\Model;

class OutcomeInRegistry extends Model
{
	protected $guarded = [];
	protected $table = 'OutcomesInRegistries';
	protected $primaryKey = ['OutcomeId', 'RegistryId'];
	public $incrementing = false;
	public $timestamps = false;
}
