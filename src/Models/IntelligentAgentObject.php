<?php

namespace BrightspaceDevHelper\DataHub\Model;

use Illuminate\Database\Eloquent\Model;

class IntelligentAgentObject extends Model {
	protected $guarded = [];
	protected $table = 'IntelligentAgentObjects';
	protected $primaryKey = 'AgentId';
	public $incrementing = false;
	public $timestamps = false;
}
