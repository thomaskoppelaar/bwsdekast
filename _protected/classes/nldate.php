<?php

class NLDate {

	public static $monthsFull = array(
		'januari', 'februari', 'maart', 'april', 'mei', 'juni', 'juli',
		'augustus', 'september', 'oktober', 'november', 'december',
	);

	public static $monthAbbrev = array(
		'jan', 'feb', 'maa', 'apr', 'mei', 'jun', 'jul', 'sep', 'aug',
		'okt', 'nov', 'dec',
	);

	public static $daysFull = array(
		'zondag', 'maandag', 'dinsdag', 'woensdag', 'donderdag', 'vrijdag',
		'zaterdag',
	);

	public static $daysAbbrev = array(
		'zo', 'ma', 'di', 'wo', 'do', 'vr', 'za',
	);

	public static $specialChars = array(
		'D' => array('daysAbbrev', 'w', 0),
		'l' => array('daysFull', 'w', 0),
		'F' => array('monthsFull', 'm', -1),
		'M' => array('monthsFull', 'm', -1),
	);

	public static function format($format, $timestamp) {
		return implode(
			'',
			array_map(
				function($capture) use ($timestamp) {
					if (isset(NLDate::$specialChars[$capture])) {
						$info = NLDate::$specialChars[$capture];
						return NLDate::${$info[0]}[ date($info[1],$timestamp) + $info[2] ];
					}
					return date($capture, $timestamp);
				},
				preg_split(
					'/([' . preg_quote(implode('', array_keys(self::$specialChars))) . '])/',
					$format,
					-1,
					PREG_SPLIT_DELIM_CAPTURE
				)
			)
		);
	}
}