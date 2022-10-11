<?php

namespace BrightspaceDevHelper\Valence\Block;

use BrightspaceDevHelper\DataHub\Model\OrganizationalUnit;
use BrightspaceDevHelper\Valence\Client\Valence;
use BrightspaceDevHelper\Valence\Object\DateTime;
use BrightspaceDevHelper\Valence\Object\NotInDatahub;
use BrightspaceDevHelper\Valence\Structure\Block;

class CourseOffering extends Block
{
	public string $Identifier;
	public string $Name;
	public string $Code;
	public bool $IsActive;
	public string|NotInDatahub $Path;
	public ?string $StartDate;
	public ?string $EndDate;
	public ?BasicOrgUnit $CourseTemplate;
	public ?BasicOrgUnit $Semester;
	public ?BasicOrgUnit $Department;
	public RichText|NotInDatahub $Description;
	public bool|NotInDatahub $CanSelfRegister;

	public function __construct(array $response, Valence $valence)
	{
		parent::__construct($response, ['CourseTemplate', 'Semester', 'Department', 'Description', 'StartDate', 'EndDate']);

		foreach (['StartDate', 'EndDate'] as $key)
			$this->$key = $response[$key] != '' ? $valence->createDateTimeFromIso8601($response[$key], $valence)->getTimestamp() : null;

		foreach (['CourseTemplate', 'Semester', 'Department'] as $key)
			if (is_array($response[$key]))
				$this->$key = new BasicOrgUnit($response[$key]);
			elseif (($response[$key] ?? '') instanceof BasicOrgUnit)
				$this->$key = $response[$key];
			else
				$this->$key = null;

		$this->Description = is_array($response['Description']) ? new RichText($response['Description']) : $response['Description'];
	}

	public static function fromDatahub(OrganizationalUnit $record, Valence $valence): CourseOffering
	{
		$a = [
			'Identifier' => $record->OrgUnitId,
			'Name' => $record->Name,
			'Code' => $record->Code,
			'IsActive' => $record->IsActive,
			'Path' => new NotInDatahub(),
			'StartDate' => DateTime::createFromTimestamp($record->StartDate, $valence)->getIso8601(),
			'EndDate' => DateTime::createFromTimestamp($record->EndDate, $valence)->getIso8601(),
			'CourseTemplate' => BasicOrgUnit::fromDatahub($record->template()->first()),
			'Semester' => BasicOrgUnit::fromDatahub($record->semester()->first()),
			'Department' => BasicOrgUnit::fromDatahub($record->department()->first()),
			'Description' => new NotInDatahub(),
			'CanSelfRegister' => new NotInDatahub()
		];

		return new CourseOffering($a, $valence);
	}
}
