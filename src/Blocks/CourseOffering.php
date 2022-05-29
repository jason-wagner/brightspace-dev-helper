<?php

namespace BrightspaceDevHelper\Valence\Block;

use BrightspaceDevHelper\Valence\Structure\Block;

class CourseOffering extends Block
{
	public string $Identifier;
	public string $Name;
	public string $Code;
	public bool $IsActive;
	public string $Path;
	public ?string $StartDate;
	public ?string $EndDate;
	public ?BasicOrgUnit $CourseTemplate;
	public ?BasicOrgUnit $Semester;
	public ?BasicOrgUnit $Department;
	public RichText$Description;
	public bool $CanSelfRegister;

	public function __construct(array $response)
	{
		parent::__construct($response, ['CourseTemplate', 'Semester', 'Department', 'Description']);

		foreach (['CourseTemplate', 'Semester', 'Department'] as $key)
			$this->$key = $response[$key] ? new BasicOrgUnit($response[$key]) : null;

		$this->Description = new RichText($response['Description']);
	}
}
