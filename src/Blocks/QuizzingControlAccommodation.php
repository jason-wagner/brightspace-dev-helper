<?php

namespace BrightspaceDevHelper\Valence\Block;

use BrightspaceDevHelper\Valence\Structure\Block;

class QuizzingControlAccommodation extends Block
{
	public bool $AlwaysAllowRightClick;

	public function __construct(array $response)
	{
		parent::__construct($response, ['AlwaysAllowRightClick']);
	}
}
