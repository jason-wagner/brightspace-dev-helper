<?php

namespace BrightspaceDevHelper\DataHub\Model;

use Illuminate\Database\Eloquent\Model;

class IntelligentAgentRunLog extends Model {
	protected $guarded = [];
	protected $table = 'IntelligentAgentRunLog';
	protected $primaryKey = 'AgentRunId';
	public $incrementing = false;
	public $timestamps = false;
}
