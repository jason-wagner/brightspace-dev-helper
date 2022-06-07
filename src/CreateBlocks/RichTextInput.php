<?php

namespace BrightspaceDevHelper\Valence\CreateBlock;

use BrightspaceDevHelper\Valence\Structure\CreateBlock;

class RichTextInput extends CreateBlock
{
	public function __construct(public string $Content,
								public string $Type)
	{

	}
}
