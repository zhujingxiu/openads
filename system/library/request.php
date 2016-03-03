<?php
class Request {
	public $get = array();
	public $post = array();
	public $cookie = array();
	public $files = array();
	public $server = array();

	public function __construct() {
		$this->get = $this->clean($_GET);
		$this->post = $this->clean($_POST);
		$this->request = $this->clean($_REQUEST);
		$this->cookie = $this->clean($_COOKIE);
		$this->files = $this->clean($_FILES);
		$this->server = $this->clean($_SERVER);
	}

	public function clean($data) {
		if (is_array($data)) {
			foreach ($data as $key => $value) {
				unset($data[$key]);

				$data[$this->clean($key)] = $this->clean($value);
			}
		} else {
			$data = htmlspecialchars($data, ENT_COMPAT, 'UTF-8');
		}

		return $data;
	}

	private function _setBaseURL($params){
		$_url = array();
		foreach($params as $key => $value){
			$_v = null;
			if(is_array($value) && isset($value['default'])){
				$_v = isset($this->get[strtolower(trim($key))]) ? $this->get[strtolower(trim($key))] : $value['default'];
			}else if(isset($this->get[strtolower(trim($value))])){
				$_v = $this->get[strtolower(trim($value))];
			}else if(isset($this->get[strtolower(trim($key))])) {
				$_v = $this->get[strtolower(trim($key))];
			}
			if(!is_null($_v))
				$_url[strtolower(trim($key))] =  is_numeric($_v) ? $_v : urlencode(html_entity_decode($_v, ENT_QUOTES, 'UTF-8'));
		}

		return $_url;
	}

	public function setUrl($params = array()){
		$_url = array();
		foreach($this->_setBaseURL($params) as $key => $value){
			$_url[] = $key.'='.$value;
		}
		return implode("&",$_url) ;
	}

	public function setOrderUrl($params = array()){
		$_url = $this->_setBaseURL($params);
		unset($_url['sort']);
		if(isset($_url['order']) && $_url['order'] == 'ASC'){
			$_url['order'] = 'DESC';
		}else{
			$_url['order'] = 'ASC';
		}
		foreach($_url as $key => $value){
			$_url[$key] = $key.'='.$value;
		}
		return implode("&",$_url);
	}

	public function setPageUrl($params = array()){
		$_url = $this->_setBaseURL($params);
		unset($_url['page']);
		foreach($_url as $key => $value){
			$_url[$key] = $key.'='.$value;
		}

		return implode("&",$_url);
	}

	public function getFilter($data =array()){
		$_filter = array();
		foreach($data as $key => $value){
			if(isset($this->get[strtolower(trim($key))])){
				$_filter[strtolower(trim($key))] = $this->get[strtolower(trim($key))];
			}else if(is_array($value) && isset($value['default'])){
				$_filter[strtolower(trim($key))] = $value['default'];
			}else{
				$_filter[strtolower(trim($key))] = null;
			}
		}
		return $_filter;
	}
}