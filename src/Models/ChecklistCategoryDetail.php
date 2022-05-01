<?php

namespace BrightspaceDevHelper\DataHub\Model;

use Illuminate\Database\Eloquent\Model;

class ChecklistCategoryDetail extends Model {
	protected $guarded = [];
	protected $table = 'ChecklistCategoryDetails';
	protected $primaryKey = 'CategoryId';
	public $incrementing = false;
	public $timestamps = false;
}
