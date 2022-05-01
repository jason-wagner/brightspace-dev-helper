<?php

namespace BrightspaceDevHelper\DataHub\Model;

use Illuminate\Database\Eloquent\Model;

class GradeScheme extends Model
{
	protected $guarded = [];
	protected $table = 'GradeSchemes';
	protected $primaryKey = ['GradeSchemeId', 'GradeSchemeRangeId'];
	public $incrementing = false;
	public $timestamps = false;
}
