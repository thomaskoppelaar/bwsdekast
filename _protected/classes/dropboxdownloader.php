<?php

class DropboxDownloader {

	protected $copied = false;

	public $url = '';

	public function __construct($url) {
		$this->url = $url;
	}

	public function getFile() {
		if ($this->copied) {
			return $this->copied;
		}

		$target = tempnam(sys_get_temp_dir(), 'news');
		if (!copy($this->url, $target)) {
			return false;
		}
		$this->copied = $target;
		return $this->copied;
	}

	public function __toString() {
		return $this->getFile();
	}

	public function getZipArchive() {
		$archive = new ZipArchive();
		$archive->open($this->getFile());
		return $archive;
	}

}
