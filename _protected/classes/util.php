<?php

class Util {

	public static function h($string, $quote_style = ENT_COMPAT, $charset = 'UTF-8', $double_encode = true) {
		return htmlentities($string, $quote_style, $charset, $double_encode);
	}

	public static function debug() {
		$arguments = func_get_args();

		foreach ($arguments as $argument) {
			echo '<pre>';
			print_r($argument);
			echo '</pre>';
		}
	}

	public static function toInitials($input) {
		return implode('', array_map(function($letter) {
			return strtoupper($letter) . '.';
		}, str_split($input)));
	}
}