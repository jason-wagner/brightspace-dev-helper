<?php

namespace BrightspaceDevHelper\DataHub\Model;

use Illuminate\Database\Eloquent\Model;

class IntelligentAgentRun extends Model
{
	protected $guarded = [];
	protected $table = 'IntelligentAgentRuns';
	protected $primaryKey = ['OrgUnitId', 'UserId', 'AgentId', 'AgentRunId'];
	public $incrementing = false;
	public $timestamps = false;
}
