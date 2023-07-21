<?php

namespace Kwerqy\Ember\com\request;

/**
 * @package mod\debug
 * @author Ryno Van Zyl
 */
class request extends \Kwerqy\Ember\com\intf\standard {
	/**
	 * @var \CodeIgniter\HTTP\IncomingRequest
	 */
	protected $request;

    /**
     * @var \CodeIgniter\HTTP\URI
     */
	protected $uri;

	protected $get_data;

	//--------------------------------------------------------------------------------
	protected function __construct($options = []) {

		$this->request = \Config\Services::request();
		$this->uri = \Config\Services::uri();
		$this->get_data = \Kwerqy\Ember\com\http\http::get_parameters();

	}
	//--------------------------------------------------------------------------------
	public function is_ajax() {
		return $this->request->isAJAX();
	}
	//--------------------------------------------------------------------------------
	public function get_csrf() {
		return csrf_hash();
	}
	//--------------------------------------------------------------------------------
	public function get_trusted($var, $data_type, $options = []) {
		$options["trusted"] = true;
		return $this->get($var, $data_type, $options);
	}
	//--------------------------------------------------------------------------------
	public function get_get($var, $data_type, $options = []) {
		$options["get"] = true;
		return $this->get($var, $data_type, $options);
	}
	//--------------------------------------------------------------------------------
	public function get_segment($index) {
		return $this->uri->getSegment($index);
	}
	//--------------------------------------------------------------------------------
	public function get_segments() {
		return $this->uri->getSegments();
	}
	//--------------------------------------------------------------------------------
	public function getdb($table, $field = false, $options = []) {

	    $options = array_merge([
		    "default" => false,
		    "get" => false,
		    "trusted" => false,
		], $options);

	    $dbt = \Kwerqy\Ember\Ember::dbt($table);

	    if($field === true) $key = $dbt->key;
	    else $key = $field;

	    $id = $this->get($key, TYPE_STRING);

	    if(!$id) return $options["default"];

	    return $dbt->find([
	        ".{$dbt->key}" => $id
        ]);

	}
	//--------------------------------------------------------------------------------
	public function get($var, $data_type = TYPE_STRING, $options = []) {
		$options = array_merge([
		    "default" => false,
		    "get" => false,
		    "trusted" => false,
		    "index" => false,
		], $options);

		$value = null;

		$fn_get_post = function() use($var) { return $this->request->getPost($var); };
		$fn_get_get = function() use($var) { return $value = $this->request->getGet($var); };

		//get from request
		if($options["get"]) $value = $fn_get_get();
		else if($options["trusted"]){
			$value = $fn_get_post();
			if(!$value) $value = $fn_get_get();
		}
		else $value = $fn_get_post();

		if(!$value) {

		    //try and request from slug
            $parameters = \Kwerqy\Ember\com\http\http::get_parameters();
            $value = isset($parameters[$var]) ? $parameters[$var] : false;
        }

		if(!$value) {
		    return \Kwerqy\Ember\com\data\data::parse($options["default"], $data_type);
        }

		if($options["index"] && is_array($value)){
		    if(isset($value[$options["index"]])) $value = $value[$options["index"]];
		    return \Kwerqy\Ember\com\data\data::parse($options["default"], $data_type);
        }
		
		//parse
		return \Kwerqy\Ember\com\data\data::parse($value, $data_type);

	}
	//--------------------------------------------------------------------------------
}