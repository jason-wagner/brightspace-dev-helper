<?php

namespace BrightspaceDevHelper\DataHub\Model;

use Illuminate\Database\Eloquent\Model;

class ChatObject extends Model {
	protected $guarded = [];
	protected $table = 'ChatObjects';
	protected $primaryKey = 'ChatId';
	public $incrementing = false;
	public $timestamps = false;
}
