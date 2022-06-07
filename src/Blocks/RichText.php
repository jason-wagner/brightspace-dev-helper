<?php

namespace BrightspaceDevHelper\Valence\Block;

use BrightspaceDevHelper\Valence\Structure\Block;
use BrightspaceDevHelper\Valence\CreateBlock\RichTextInput;

class RichText extends Block
{
	public string $Text;
	public ?string $Html;

	public function toInput(): RichTextInput
	{
		return $this->Html ? new RichTextInput($this->Html, 'Html') : new RichTextInput($this->Text, 'Text');
	}
}
