<?php

namespace BrightspaceDevHelper\Valence\Object;

use BrightspaceDevHelper\Valence\Client\Valence;
use Carbon\Carbon;

class DateTime
{
	public const FORMAT_TIMESTAMP = 'Y-m-d H:i:s';
	public const FORMAT_ISO8601 = 'Y-m-d\TH:i:s.v\Z';

	public function __construct(public Carbon $carbon, public Valence $valence)
	{
		if ($this->valence->getTimezoneConvert())
			$carbon->setTimezone($this->valence->getTimezone());
	}

	public static function createFromIso8601(string $datetime, Valence $valence): DateTime
	{
		return new DateTime(Carbon::createFromFormat(self::FORMAT_ISO8601, $datetime, 'UTC'), $valence);
	}

	public static function createFromTimestamp(string $datetime, Valence $valence): DateTime
	{
		return new DateTime(Carbon::createFromFormat(self::FORMAT_TIMESTAMP, $datetime, $valence->getTimezoneConvert() ? $valence->getTimezone() : 'UTC'), $valence);
	}

	public static function createFromComponents(int $year, int $month, int $day, int $hour, int $minute, int $second, Valence $valence): DateTime
	{
		return new DateTime(Carbon::create($year, $month, $day, $hour, $minute, $second, $valence->getTimezoneConvert() ? $valence->getTimezone() : 'UTC'), $valence);
	}

	public function getIso8601(): string
	{
		return $this->carbon->setTimezone('UTC')->format(self::FORMAT_ISO8601);
	}

	public function getTimestamp(): string
	{
		return $this->carbon->format(self::FORMAT_TIMESTAMP);
	}
}
