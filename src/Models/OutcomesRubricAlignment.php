<?php

namespace BrightspaceDevHelper\DataHub\Model;

use Illuminate\Database\Eloquent\Model;

class OutcomesRubricAlignment extends Model
{
	protected $guarded = [];
	protected $table = 'OutcomesRubricAlignments';
	protected $primaryKey = ['RubricId', 'CriterionId', 'OutcomeId', 'RegistryId'];
	public $incrementing = false;
	public $timestamps = false;
}
