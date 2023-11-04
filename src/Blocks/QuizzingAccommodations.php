<?php

namespace BrightspaceDevHelper\Valence\Block;

use BrightspaceDevHelper\Valence\Structure\Block;

class QuizzingAccommodations extends Block
{
	public QuizzingControlAccommodation $QuizzingControlAccommodation;
	public QuizzingTimeLimitAccommodation $QuizzingTimeLimitAccommodation;

	public function __construct(array $response)
	{
		parent::__construct($response, ['QuizzingControlAccommodation', 'QuizzingTimeLimitAccommodation']);

		$this->QuizzingControlAccommodation = new QuizzingControlAccommodation($response['QuizzingControlAccommodation']);
		$this->QuizzingTimeLimitAccommodation = new QuizzingTimeLimitAccommodation($response['QuizzingTimeLimitAccommodation']);
	}
}
