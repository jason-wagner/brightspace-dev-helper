<?php

namespace BrightspaceDevHelper\DataHub\Model;

use Illuminate\Database\Eloquent\Model;

class ChecklistItemDetail extends Model {
	protected $guarded = [];
	protected $table = 'ChecklistItemDetails';
	protected $primaryKey = 'ItemId';
	public $incrementing = false;
	public $timestamps = false;
}
