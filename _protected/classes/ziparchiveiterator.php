<?php
// Based on https://gist.github.com/stealth35/1320041
class ZipArchiveIterator implements \Iterator, \SeekableIterator, \Countable
{
	private $current;
	private $position;
	private $zip;

	public function __construct(ZipArchive $zip) {
		$this->zip = $zip;
		$this->seek(0);
	}

	public static function createFromFile($fileName) {
		$zip = new \ZipArchive();
		$zip->open($fileName);
		return new static($zip);
	}

	public function current() {
		return $this->current;
	}

	public function key() {
		return $this->position;
	}

	public function next() {
		$this->seek(++$this->position);
	}

	public function rewind() {
		$this->seek(0);
	}

	public function valid() {
		return $this->current;
	}

	public function seek($position) {
		$this->position = $position;
		$this->current = $this->zip->statIndex($position);
	}

	public function count() {
		return $this->zip->numFiles;
	}

	public function zip() {
		return $this->zip;
	}

	public function getStream() {
		return $this->zip->getStream( $this->current['name']);
	}

	public function content() {
		return $this->zip->getFromIndex( $this->position );
	}

	public function __toString() {
		return $this->current['name'];
	}
}