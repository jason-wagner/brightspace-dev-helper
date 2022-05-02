<?php

namespace BrightspaceDevHelper\DataHub\Model;

use Illuminate\Database\Eloquent\Model;

class ContentPublisherLaunch extends Model
{
	protected $guarded = [];
	protected $table = 'ContentPublisherLaunches';
	protected $primaryKey = 'LaunchId';
	public $incrementing = false;
	public $timestamps = false;
}
