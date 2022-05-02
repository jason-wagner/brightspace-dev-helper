<?php

namespace BrightspaceDevHelper\DataHub\Model;

use Illuminate\Database\Eloquent\Model;

class OutcomeAlignmentToToolObject extends Model
{
	protected $guarded = [];
	protected $table = 'OutcomeAlignmentToToolObjects';
	protected $primaryKey = ['ObjectType', 'ObjectId', 'OutcomeId', 'RegistryId'];
	public $incrementing = false;
	public $timestamps = false;
}
