<?php

class Cache {

	protected static $folder = 'cache';
	protected static $defaultExpiry = 3600;

	public static function configure($folder, $defaultExpiry) {
		self::$folder = $folder;
		self::$defaultExpiry = $defaultExpiry;
	}

	public static function get($domain, $callback = null, $expire = null) {
		$file = self::getFileName($domain);
		if (file_exists($file)) {
			$content = unserialize(file_get_contents($file));
		}

		if (isset($content) && $content['expire'] > time()) {
			return $content['value'];
		}

		if (!is_null($callback)) {
			$value = call_user_func($callback);
			self::set($domain, $value, $expire);
			return $value;
		}

		return null;
	}

	public static function exists($domain) {
		$file = self::getFileName($domain);
		if (!file_exists($file)) {
			return false;
		}

		$content = unserialize(file_get_contents($file));
		return ($content['expire'] > time());
	}

	public static function set($domain, $value, $expire) {
		self::write($domain, $value, self::getExpire($expire));
	}

	public static function delete($domain) {
		$file = self::getFileName($domain);
		if (file_exists($file)) {
			return unlink($file);
		}
		return false;
	}

	protected static function getExpire($expire) {
		if (is_null($expire)) {
			$expire = self::$defaultExpiry;
		}

		if (is_int($expire))
			return time() + $expire;
		if (is_string($expire))
			return strtotime($expire);
		return false;
	}

	protected static function getFileName($domain) {
		return self::$folder . '/' . strtolower($domain) . '.php';
	}

	protected static function write($domain, $value, $expire) {
		$file = self::getFileName($domain);
		return file_put_contents($file, serialize(array('value' => $value, 'expire' => $expire)));
	}
}