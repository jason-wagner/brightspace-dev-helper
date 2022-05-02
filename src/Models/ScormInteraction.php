<?php

namespace BrightspaceDevHelper\DataHub\Model;

use Illuminate\Database\Eloquent\Model;

class ScormInteraction extends Model
{
	protected $guarded = [];
	protected $table = 'ScormInteractions';
	protected $primaryKey = 'InteractionId';
	public $incrementing = false;
	public $timestamps = false;
}
