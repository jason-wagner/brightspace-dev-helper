<?php

use Illuminate\Database\Eloquent\Model;

class ChatSessionLog extends Model {
	protected $guarded = [];
	protected $table = 'ChatSessionLog';
	protected $primaryKey = 'MessageId';
	public $incrementing = false;
	public $timestamps = false;
}
