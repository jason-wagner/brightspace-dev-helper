<?php

namespace BrightspaceDevHelper\Valence\Block;

use BrightspaceDevHelper\Valence\Structure\Block;

class CourseOffering extends Block
{
	public $Identifier;
	public $Name;
	public $Code;
	public $IsActive;
	public $Path;
	public $StartDate;
	public $EndDate;
	public $CourseTemplate;
	public $Semester;
	public $Department;
	public $Description;
	public $CanSelfRegister;

	public function __construct(array $response)
	{
		parent::__construct($response, ['CourseTemplate', 'Semester', 'Department', 'Description']);

		foreach (['CourseTemplate', 'Semester', 'Department'] as $key)
			$this->$key = $response[$key] ? new BasicOrgUnit($response[$key]) : null;

		$this->Description = new RichText($response['Description']);
	}
}
