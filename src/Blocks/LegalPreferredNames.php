<?php

namespace BrightspaceDevHelper\Valence\Block;

use BrightspaceDevHelper\Valence\Structure\Block;

class LegalPreferredNames extends Block
{
	public string $LegalFirstName;
	public string $LegalLastName;
	public ?string $PreferredFirstName;
	public ?string $PreferredLastName;
	public ?string $SortLastName;
}
