<?php

namespace BrightspaceDevHelper\DataHub\Model;

use Illuminate\Database\Eloquent\Model;

class CompetencyStructure extends Model {
	protected $guarded = [];
	protected $table = 'CompetencyStructure';
	protected $primaryKey = ['ObjectId', 'ParentObjectId', 'BaseObjectId', 'EntryTime'];
	public $incrementing = false;
	public $timestamps = false;
}
