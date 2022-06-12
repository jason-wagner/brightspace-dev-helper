<?php

namespace BrightspaceDevHelper\Valence\BlockArray;

use BrightspaceDevHelper\Valence\Block\OrgUnitUser;
use BrightspaceDevHelper\Valence\Client\Valence;
use BrightspaceDevHelper\Valence\Structure\BlockArray;

class OrgUnitUserArray extends BlockArray
{
	public string $blockClass = OrgUnitUser::class;
	public int $orgUnitId;

	public function __construct(array $response, int $orgUnitId)
	{
		$this->orgUnitId = $orgUnitId;
		parent::__construct($response);
	}

	public function build(array $response): void
	{
		$this->nextPageRoute = $response['PagingInfo']['HasMoreItems'] ? "/d2l/api/lp/" . Valence::VERSION_LP . "/enrollments/orgUnits/{$this->orgUnitId}/users/?isActive=1&bookmark=" . $response['PagingInfo']['Bookmark'] : null;
		parent::build($response['Items']);
	}

	public function current(): ?OrgUnitUser
	{
		return parent::current();
	}
}
