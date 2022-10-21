<?php

namespace BrightspaceDevHelper\Valence\BlockArray;

use BrightspaceDevHelper\Valence\Block\SocialMediaUrl;
use BrightspaceDevHelper\Valence\Structure\BlockArray;

class SocialMediaUrls extends BlockArray
{
	public string $blockClass = SocialMediaUrl::class;

	public function current(): ?SocialMediaUrl
	{
		return parent::current();
	}
}
