<?php

namespace Kwerqy\Ember\com\ci\controller;

/**
 * @package mod
 * @author Ryno Van Zyl
 * @copyright Copyright Liquid Edge Solutions. All rights reserved.
 */
class controller{

    protected $options = [];


    protected $cache;
    public \Kwerqy\Ember\com\intf\section $section;

    public string $layout;
    public string $role;
    public string $auth;

    //--------------------------------------------------------------------------------
    protected function __construct($options = []) {

        $this->options = $options;
        $this->cache = \Kwerqy\Ember\com\cache\cache::make(["cache_id" => "controller"])->clear();

        foreach ($this->options as $key => $data){
            $this->cache->{$key} = $data;
        }

    }
    //--------------------------------------------------------------------------------
    public function __set($name, $value) {
        $this->set($name, $value);
    }
    //--------------------------------------------------------------------------------
    public function __get($name) {
        return $this->get($name);
    }
    //--------------------------------------------------------------------------------
    public function set($name, $value) {
        $this->cache->{$name} = $value;
    }
    //--------------------------------------------------------------------------------
    public function get($name, $options = []) {

        $options = array_merge([
            "default" => false,
        ], $options);

        //try to find data in URL
        $control = \Kwerqy\Ember\com\http\http::get_control();
        if(strpos($control, $name) !== false){
            $control_parts = explode("/", $control);
            $key = array_search($name, $control_parts);
            $value = isset($control_parts[$key+1]) ? $control_parts[$key+1] : false;
            if($value) return $value;
        }

        $value = $this->cache->get($name);
        if($value) return $value;

        return $options["default"];
    }
    //--------------------------------------------------------------------------------
    /**
     * @param array $options
     * @return static
     */
	public static function make($options = []) {
		return new static($options);
	}
    //--------------------------------------------------------------------------------
	public function build($section, $page, $options = []) {

	    $options = array_merge([
	        "auth" => ""
	    ], $options, $this->options);
	    $this->auth = $options["auth"];

	    $this->section = \Kwerqy\Ember\Ember::get_section($section);
	    $this->layout = $this->section->get_layout();

	    //check controller auth
        if($this->auth && !\Kwerqy\Ember\Ember::auth_check($this->auth)){
            return \Kwerqy\Ember\com\http\http::go_error(ERROR_CODE_ACCESS_DENIED, ["layout" => $this->layout,]);
        }

	    $options = array_merge([
	        "data" => [],
	        "pre_layout" => [
	            "{$this->layout}/layout/head",
                "{$this->layout}/layout/banner",
                "{$this->layout}/layout/navbar",
            ],
            "post_layout" => [
                "{$this->layout}/layout/footer",
                "{$this->layout}/layout/scripts",
            ],
	    ], $options);

	    if(\Kwerqy\Ember\com\http\http::is_panel_request()){
	        $options["pre_layout"] = [];
	        $options["post_layout"] = [];
        }

	    $options["controller"] = $this;

	    $view_arr = [];
	    foreach ($options["pre_layout"] as $name) $view_arr[$name] = $name;
	    $view_arr["body"] = $page;
	    foreach ($options["post_layout"] as $name) $view_arr[$name] = $name;

        foreach ($this->parse_uri_segments($view_arr["body"]) as $key => $data){
            $this->{$key} = $data;
        }

        foreach ($options["data"] as $key => $data){
            $this->{$key} = $data;
        }

        //first init body to evaluate auth methods
        $body = view($view_arr["body"], $options);

	    $view_str = "";
	    foreach ($view_arr as $index => $view){
	        if($index == "body"){
	            if (!is_file(APPPATH . "Views/{$view}.php")) {
                    // Whoops, we don't have a page for that!
                    throw new \CodeIgniter\Exceptions\PageNotFoundException("home");
                }
	            $panel = \Kwerqy\Ember\com\ui\ui::make()->panel(current_url());
                $panel->set_id("mod");
                $panel->set_html($body);
                $view_str .= $panel->build();
            }else{
	            if (is_file(APPPATH . "Views/{$view}.php")) {
                    $view_str .= view($view, $options);
                }
            }
        }

	    if(\Kwerqy\Ember\com\http\http::is_panel_request()){
            $view_str = str_replace(["\\n", "\\t", "\\"], "", $view_str);
	        \Kwerqy\Ember\com\http\http::json(substr($view_str, 1, strlen($view_str)-1));
	        exit();
        }

		return $view_str;
	}
    //--------------------------------------------------------------------------------
    private function parse_uri_segments($route) {

	    $data_arr = [];

	    $route_arr = explode("/", $route);
	    $segment_arr = \Kwerqy\Ember\Ember::$request->get_segments();


	    foreach ($segment_arr as $index => $value){
	        if(in_array($value, $route_arr)) continue;
	        $data_arr[] = $value;
        }

	    if(sizeof($data_arr) == 0) return [];
	    if(sizeof($data_arr) == 1) return ["id" => reset($data_arr)];

        return array_combine(array_filter($data_arr, function ($k) {
            return !($k & 1);
        }, ARRAY_FILTER_USE_KEY), array_filter($data_arr, function ($k) {
            return ($k & 1);
        }, ARRAY_FILTER_USE_KEY));

    }
    //--------------------------------------------------------------------------------

}
