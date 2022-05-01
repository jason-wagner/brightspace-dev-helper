<?php

namespace BrightspaceDevHelper\DataHub\Model;

use Illuminate\Database\Eloquent\Model;

class QuestionRelationship extends Model
{
	protected $guarded = [];
	protected $table = 'QuestionRelationships';
	protected $primaryKey = ['CollectionId', 'QuestionId', 'QuestionVersionId', 'ObjectId'];
	public $incrementing = false;
	public $timestamps = false;
}
