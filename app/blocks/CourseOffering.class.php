<?php

namespace ValenceHelper\Block;

use ValenceHelper\Block;

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
		foreach (['Identifier', 'Name', 'Code', 'IsActive', 'Path', 'StartDate', 'EndDate', 'CanSelfRegister'] as $key)
			$this->$key = $response[$key];

		foreach (['CourseTemplate', 'Semester', 'Department'] as $key)
			$this->$key = $response[$key] ? new BasicOrgUnit($response[$key]) : null;

		$this->Description = new RichText($response['Description']);
	}
}
