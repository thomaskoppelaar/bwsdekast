<?php

class Config {

	protected $data = array();

	public static function get($config) {
		$fn = '_protected/config/' . strtolower($config) . '.php';
		if (!file_exists($fn)) {
			throw new Exception("Configuration for " . $config . " was not found");
		}

		return require $fn;
	}
}