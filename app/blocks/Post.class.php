<?php

namespace ValenceHelper\Block;

use ValenceHelper\Block;

class Post extends Block
{
	public $ForumId;
	public $PostId;
	public $TopicId;
	public $PostingUserId;
	public $PostingUserDisplayName;
	public $ThreadId;
	public $ParentPostId;
	public $Message;
	public $Subject;
	public $DatePosted;
	public $IsAnonymous;
	public $RequiresApproval;
	public $IsDeleted;
	public $LastEditedDate;
	public $LastEditedBy;
	public $CanRate;
	public $ReplyPostIds;
	public $WordCount;
	public $AttachmentCount;

	public function __construct(array $response)
	{
		parent::__construct($response, ['Message']);
		$this->Message = new RichText($response['Message']);
	}
}
