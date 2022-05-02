<?php

namespace BrightspaceDevHelper\DataHub\Model;

use Illuminate\Database\Eloquent\Model;

class OutcomeDetail extends Model
{
	protected $guarded = [];
	protected $table = 'OutcomeDetails';
	protected $primaryKey = 'OutcomeId';
	public $incrementing = false;
	public $timestamps = false;
}
