<?php

class Page implements ArrayAccess {

	public $pages;
	public $pagemaps;
	public $path;
	public $info;
	public $current;
	public $code = 200;

	protected $_viewData;

	public function __construct($page = null) {
		$config = Config::get('pages');
		$this->pages = $config['pages'];
		$this->pagemaps = $config['pagemaps'];

		if ($page) {
			$this->determine($page);
		}
	}

	public function headers() {
		header('Content-Type: text/html;charset=UTF-8', true, $this->code);
	}

	public function determine($request) {
		if (isset($this->pagemaps[$request])) {
			$request = $this->pagemaps[$request];
		}

		$parts = explode('/', $request);
		$curPage = $this->pages;
		$error = false;
		$path = array();

		foreach ($parts as $part) {
			if (empty($curPage['subpages'])) {
				if (empty($curPage[$part])) {
					$error = '404'; break;
				}
				$curPage = $curPage[$part];
			}
			else {
				if (empty($curPage['subpages'][$part])) {
					$error = '404'; break;
				}
				$curPage = $curPage['subpages'][$part];
			}
			$path[$part] = $curPage;
		}

		if ($error) {
			$this->code = $error;
			$this->info = $this->pages[$error];
			$this->path = array($error => $this->info);
			$this->current = $error;
			return;
		}

		$this->current = $part;
		$this->info = $curPage;
		$this->path = $path;
	}

	protected function _safeInclude($__file) {
		$page = $this;
		require $__file;
	}

	public function includeMixin($mixin) {
		$this->_safeInclude('mixin/' . $mixin . '.php');
	}

	public function includePage() {
		$base = 'pages/';
		$lmin = count($this->path) - 1;
		if ($lmin > 0) {
			$base .= implode('/', array_keys(array_slice($this->path, 0, $lmin, true))) . '/';
		}

		if (stream_resolve_include_path($base . '_before.php') !== false) {
			$this->_safeInclude($base . '_before.php');
		}

		$this->_safeInclude($base . $this->current . '.php');

		if (stream_resolve_include_path($base . '_after.php') !== false) {
			$this->_safeInclude($base . '_after.php');
		}
	}

    public function offsetSet($offset, $value) {
        if (is_null($offset)) {
            $this->_viewData[] = $value;
        } else {
            $this->_viewData[$offset] = $value;
        }
    }

    public function offsetExists($offset) {
        return isset($this->_viewData[$offset]);
    }

    public function offsetUnset($offset) {
        if ($this->offsetExists($offset)) {
            unset($this->_viewData[$offset]);
        }
    }

    public function offsetGet($offset) {
        return $this->offsetExists($offset) ? $this->_viewData[$offset] : null;
    }
}