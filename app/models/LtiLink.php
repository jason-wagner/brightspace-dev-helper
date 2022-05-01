<?php

use Illuminate\Database\Eloquent\Model;

class LtiLink extends Model {
	protected $guarded = [];
	protected $table = 'LtiLinks';
	protected $primaryKey = 'LtiLinkId';
	public $incrementing = false;
	public $timestamps = false;
}
