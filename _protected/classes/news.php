<?php

class News {

	public $path;
	public $dllink;
	public $cachetime;

	public function __construct($config) {
		$this->path = $config['newsfolder'];
		$this->dllink = $config['publiclink'];
		$this->cachetime = $config['interval'];
	}

	public function getNewsFiles($forceRefresh = false) {
		$this->refreshNews($forceRefresh);

		$info = array();
		$ctimes = array();

		$override = $this->getOverride();

		foreach(new DirectoryIterator($this->path) as $item) {

			if ($item->isDir() || $item->isLink() || substr($item->getBaseName(), -3) !== ".md") {
				continue;
			}

			$add = array(
				'atime' => $item->getATime(),
				'mtime' => $item->getMTime(),
				'ctime' => $item->getCTime(),
				'name' => $item->getBasename(),
			);

			if (isset($override[$item->getBasename()])) {
				$add = $override[$item->getBasename()] + $add;
			}

			$info[] = $add;
			$ctimes[] = $add['ctime'];
		}

		array_multisort($ctimes, SORT_DESC, $info);
		return $info;
	}

	public function getOverride() {
		if (!file_exists($this->path . DIRECTORY_SEPARATOR . 'override.txt')) {
			return array();
		}

		$lines = file($this->path . DIRECTORY_SEPARATOR . 'override.txt');
		$result = array();
		foreach ($lines as $line) {
			if ($line[0] === "#" || $line[0] === ";") {
				continue;
			}

			$parts = preg_split("/\\t+/", $line, 2);
			if (empty($parts[1])) {
				continue;
			}

			$result[$parts[0]] = json_decode($parts[1], true);
		}
		return $result;
	}

	public function refreshNews($force = false) {
		if ($this->cachetime && !$force && Cache::exists('news_update')) {
			return true;
		}

		$iterator = ZipArchiveIterator::createFromFile(new DropboxDownloader($this->dllink));

		foreach ($iterator as $entry) {

			if (strpos($entry['name'], '/') !== false || substr($entry['name'], -3) !== ".md") {
				continue;
			}

			$local = $this->path . '/' . $entry['name'];
			$content = $iterator->content();
			file_put_contents($local, $content);
			touch($local, $entry['mtime']);
		}

		Cache::set('news_update', true, $this->cachetime);
		return true;
	}

	public function readNewsFile($item) {
		$lines = file($this->path . DIRECTORY_SEPARATOR . $item['name']);
		$title = array_shift($lines);

		$cache = array();
		$paragraphs = array();

		while ($line = array_shift($lines)) {
			$line = trim($line);

			if (!$line && $cache) {
				$paragraphs[] = implode(" ", $cache);
				$cache = array();
			}
			elseif ($line) {
				$cache[] = $line;
			}
		}
		if ($cache) {
			$paragraphs[] = implode(" ", $cache);
		}

		return array(
			'title' => $title,
			'paragraphs' => $paragraphs,
			'atime' => $item['mtime'],
			'mtime' => $item['mtime'],
			'ctime' => $item['ctime'],
		);
	}
}