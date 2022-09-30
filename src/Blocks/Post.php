<?php

namespace BrightspaceDevHelper\Valence\Block;

use BrightspaceDevHelper\Valence\Structure\Block;

class Post extends Block
{
	public int $ForumId;
	public int $PostId;
	public int $TopicId;
	public ?int $PostingUserId;
	public int $PostingUserDisplayName;
	public int $ThreadId;
	public ?int $ParentPostId;
	public RichText $Message;
	public string $Subject;
	public string $DatePosted;
	public bool $IsAnonymous;
	public bool $RequiresApproval;
	public bool $IsDeleted;
	public ?string $LastEditedDate;
	public ?int $LastEditedBy;
	public bool $CanRate;
	public $ReplyPostIds;
	public array $WordCount;
	public int $AttachmentCount;

	public function __construct(array $response, Valence $valence)
	{
		parent::__construct($response, ['Message', 'DatePosted', 'LastEditDate']);

		foreach (['DatePosted', 'LastEditDate'] as $key)
			$this->$key = $response[$key] != '' ? $valence->createDateTimeFromIso8601($response[$key], $valence)->getTimestamp() : null;

		$this->Message = new RichText($response['Message']);
	}
}
