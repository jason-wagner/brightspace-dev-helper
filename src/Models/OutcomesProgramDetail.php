<?php

namespace BrightspaceDevHelper\DataHub\Model;

use Illuminate\Database\Eloquent\Model;

class OutcomesProgramDetail extends Model
{
	protected $guarded = [];
	protected $table = 'OutcomesProgramDetails';
	protected $primaryKey = 'ProgramId';
	public $incrementing = false;
	public $timestamps = false;
}
