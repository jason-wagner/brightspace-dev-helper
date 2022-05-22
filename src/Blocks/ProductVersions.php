<?php

namespace BrightspaceDevHelper\Valence\Block;

use BrightspaceDevHelper\Valence\Structure\Block;

class ProductVersions extends Block
{
	public string $ProductCode;
	public string $LatestVersion;
	public array $SupportedVersions;
}
