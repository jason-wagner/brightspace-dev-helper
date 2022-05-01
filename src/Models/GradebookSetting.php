<?php

namespace BrightspaceDevHelper\DataHub\Model;

use Illuminate\Database\Eloquent\Model;

class GradebookSetting extends Model {
	protected $guarded = [];
	protected $table = 'GradebookSettings';
	protected $primaryKey = ['OrgUnitId', 'GradeSchemeId'];
	public $incrementing = false;
	public $timestamps = false;
}
