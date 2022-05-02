<?php

namespace BrightspaceDevHelper\DataHub\Model;

use Illuminate\Database\Eloquent\Model;

class ContentPublisherRecipient extends Model
{
	protected $guarded = [];
	protected $table = 'ContentPublisherRecipients';
	protected $primaryKey = 'RecipientId';
	public $incrementing = false;
	public $timestamps = false;
}
