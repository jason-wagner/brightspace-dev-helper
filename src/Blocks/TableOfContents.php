<?php

namespace BrightspaceDevHelper\Valence\Block;

use BrightspaceDevHelper\Valence\BlockArray\TableOfContentsModuleArray;
use BrightspaceDevHelper\Valence\BlockArray\TableOfContentsTopicArray;
use BrightspaceDevHelper\Valence\Client\Valence;
use BrightspaceDevHelper\Valence\Structure\Block;

class TableOfContents extends Block
{
	public TableOfContentsModuleArray $Modules;
	public TableOfContentsTopicArray $Topics;

	public function __construct(array $response, Valence $valence)
	{
		$this->Modules = new TableOfContentsModuleArray($response['Modules'] ?? [], $valence);
		$this->Topics = new TableOfContentsTopicArray($response['Topics'] ?? [], $valence);
	}
}
