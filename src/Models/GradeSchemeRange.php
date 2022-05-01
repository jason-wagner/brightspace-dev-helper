<?php

namespace BrightspaceDevHelper\DataHub\Model;

use Illuminate\Database\Eloquent\Model;

class GradeSchemeRange extends Model {
	protected $guarded = [];
	protected $table = 'GradeSchemeRanges';
	protected $primaryKey = ['GradeSchemeRangeId', 'GradeSchemeId'];
	public $incrementing = false;
	public $timestamps = false;
}
