<?php

namespace BrightspaceDevHelper\Valence\Block;

use BrightspaceDevHelper\Valence\Client\Valence;
use BrightspaceDevHelper\Valence\Structure\Block;

class NewsItem extends Block
{
	public int $Id;
	public bool $IsHidden;
	public array $Attachments;
	public string $Title;
	public RichText $Body;
	public ?int $CreatedBy;
	public ?string $CreatedDate;
	public ?int $LastModifiedBy;
	public ?string $LastModifiedDate;
	public ?string $StartDate;
	public ?string $EndDate;
	public bool $IsGlobal;
	public bool $IsPublished;
	public bool $ShowOnlyInCourseOfferings;
	public bool $IsAuthorInfoShown;

	public function __construct(array $response, Valence $valence)
	{
		parent::__construct($response, ['Attachments', 'Body', 'CreatedDate', 'LastModifiedDate', 'StartDate', 'EndDate']);

		foreach (['CreatedDate', 'LastModifiedDate', 'StartDate', 'EndDate'] as $key)
			$this->$key = $response[$key] != '' ? $valence->createDateTimeFromIso8601($response[$key], $valence)->getTimestamp() : null;

		$this->Body = new RichText($response['Body']);

		$this->Attachments = $response['Attachments'];
	}
}
