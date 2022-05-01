<?php

use Illuminate\Database\Eloquent\Model;

class RoleDetail extends Model {
	protected $guarded = [];
	protected $table = 'RoleDetails';
	protected $primaryKey = 'RoleId';
	public $incrementing = false;
	public $timestamps = false;
}
