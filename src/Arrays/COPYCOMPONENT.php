<?php

namespace BrightspaceDevHelper\Valence\Array;

class COPYCOMPONENT
{
	public bool $AttendanceRegisters = true;
	public bool $Awards = true;
	public bool $Checklists = true;
	public bool $Competencies = true;
	public bool $Content = true;
	public bool $CourseAppearance = true;
	public bool $CourseFiles = true;
	public bool $Discussions = true;
	public bool $DisplaySettings = true;
	public bool $Dropbox = true;
	public bool $Faq = true;
	public bool $Forms = true;
	public bool $GameBasedLearning = true;
	public bool $Glossary = true;
	public bool $Grades = true;
	public bool $GradesSettings = true;
	public bool $Groups = true;
	public bool $Homepages = true;
	public bool $IntelligentAgents = true;
	public bool $LearningOutcomes = true;
	public bool $Links = true;
	public bool $LtiLink = true;
	public bool $LtiTP = true;
	public bool $Navbars = true;
	public bool $News = true;
	public bool $QuestionLibrary = true;
	public bool $Quizzes = true;
	public bool $ReleaseConditions = true;
	public bool $Rubrics = true;
	public bool $S3Model = true;
	public bool $Schedule = true;
	public bool $SelfAssessments = true;
	public bool $Surveys = true;
	public bool $ToolNames = true;
	public bool $Widgets = true;

	public function __construct(bool $defaultValue) {
		foreach($this as $k => $v)
			$this->$k = $defaultValue;
	}

	public function toArray(): array {
		$a = [];

		foreach($this as $k => $v)
			if($v)
				$a[] = $k;

		return $a;
	}

	public function setAttendanceRegisters(bool $value): void {
		$this->AttendanceRegisters = $value;
	}

	public function setAwards(bool $value): void {
		$this->Awards = $value;
	}

	public function setChecklists(bool $value): void {
		$this->Checklists = $value;
	}

	public function setCompetencies(bool $value): void {
		$this->Competencies = $value;
	}

	public function setContent(bool $value): void {
		$this->Content = $value;
	}

	public function setCourseAppearance(bool $value): void {
		$this->CourseAppearance = $value;
	}

	public function setCourseFiles(bool $value): void {
		$this->CourseFiles = $value;
	}

	public function setDiscussions(bool $value): void {
		$this->Discussions = $value;
	}

	public function setDisplaySettings(bool $value): void {
		$this->DisplaySettings = $value;
	}

	public function setDropbox(bool $value): void {
		$this->Dropbox = $value;
	}

	public function setFaq(bool $value): void {
		$this->Faq = $value;
	}

	public function setForms(bool $value): void {
		$this->Forms = $value;
	}

	public function setGameBasedLearning(bool $value): void {
		$this->GameBasedLearning = $value;
	}

	public function setGlossary(bool $value): void {
		$this->Glossary = $value;
	}

	public function setGrades(bool $value): void {
		$this->Grades = $value;
	}

	public function setGradesSettings(bool $value): void {
		$this->GradesSettings = $value;
	}

	public function setGroups(bool $value): void {
		$this->Groups = $value;
	}

	public function setHomepages(bool $value): void {
		$this->Homepages = $value;
	}

	public function setIntelligentAgents(bool $value): void {
		$this->IntelligentAgents = $value;
	}

	public function setLearningOutcomes(bool $value): void {
		$this->LearningOutcomes = $value;
	}

	public function setLinks(bool $value): void {
		$this->Links = $value;
	}

	public function setLtiLink(bool $value): void {
		$this->LtiLink = $value;
	}

	public function setLtiTP(bool $value): void {
		$this->LtiTP = $value;
	}

	public function setNavbars(bool $value): void {
		$this->Navbars = $value;
	}

	public function setNews(bool $value): void {
		$this->News = $value;
	}

	public function setQuestionLibrary(bool $value): void {
		$this->QuestionLibrary = $value;
	}

	public function setQuizzes(bool $value): void {
		$this->Quizzes = $value;
	}

	public function setReleaseConditions(bool $value): void {
		$this->ReleaseConditions = $value;
	}

	public function setRubrics(bool $value): void {
		$this->Rubrics = $value;
	}

	public function setS3Model(bool $value): void {
		$this->S3Model = $value;
	}

	public function setSchedule(bool $value): void {
		$this->Schedule = $value;
	}

	public function setSelfAssessments(bool $value): void {
		$this->SelfAssessments = $value;
	}

	public function setSurveys(bool $value): void {
		$this->Surveys = $value;
	}

	public function setToolNames(bool $value): void {
		$this->ToolNames = $value;
	}

	public function setWidgets(bool $value): void {
		$this->Widgets = $value;
	}
}
