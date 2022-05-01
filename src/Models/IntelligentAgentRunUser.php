<?php

namespace BrightspaceDevHelper\DataHub\Model;

use Illuminate\Database\Eloquent\Model;

class IntelligentAgentRunUser extends Model
{
	protected $guarded = [];
	protected $table = 'IntelligentAgentRunUsers';
	protected $primaryKey = ['AgentId', 'AgentRunId', 'UserId'];
	public $incrementing = false;
	public $timestamps = false;
}
