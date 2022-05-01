<?php

use Illuminate\Database\Eloquent\Model;

class CourseAward extends Model {
	protected $guarded = [];
	protected $table = 'CourseAwards';
	protected $primaryKey = 'AssociationId';
	public $incrementing = false;
	public $timestamps = false;
}
