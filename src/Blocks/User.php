<?php

namespace BrightspaceDevHelper\Valence\Block;

use BrightspaceDevHelper\Valence\Structure\Block;

class User extends Block
{
	public ?string $Identifier;
	public ?string $DisplayName;
	public ?string $EmailAddress;
	public ?string $OrgDefinedId;
	public ?string $ProfileBadgeUrl;
	public ?string $ProfileIdentifier;
}
