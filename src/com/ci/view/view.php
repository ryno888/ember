<?php

namespace Kwerqy\Ember\com\ci\view;

/**
 * @package mod
 * @author Ryno Van Zyl
 * @copyright Copyright Liquid Edge Solutions. All rights reserved.
 */
class view {

    /**
     * @var \Kwerqy\Ember\com\ci\controller\controller
     */
    protected $controller;

    /**
     * @var \Kwerqy\Ember\com\intf\section
     */
    protected $section;

    protected string $auth;

    //--------------------------------------------------------------------------------
    public function __construct($controller, $options = []) {
        $options = array_merge([
            "section" => $controller->section,
            "auth" => "",
        ], $options);

        $this->controller = $controller;
        $this->set_section($options["section"]);
        $this->set_auth($options["auth"]);

    }
    //--------------------------------------------------------------------------------
    /**
     * @param string $auth
     */
    public function set_auth(string $auth): void {
        $this->auth = $auth;
    }
    //--------------------------------------------------------------------------------
	public function set_section($section) {

		if($section instanceof \Kwerqy\Ember\com\intf\section){
			$this->section = $section;
		} else if(is_string($section)){
			$this->section = \Kwerqy\Ember\Ember::get_section($section);
		}
	}
    //--------------------------------------------------------------------------------
    public function __get($name) {
        if(property_exists($this, $name)){
            return $this->{$name};
        }

        return $this->controller->{$name};
    }

    //--------------------------------------------------------------------------------
    public function run($fn){

        if($this->auth && !\Kwerqy\Ember\Ember::auth_check($this->auth)){
            return \Kwerqy\Ember\com\http\http::go_error(ERROR_CODE_ACCESS_DENIED);
        }

        $buffer = \Kwerqy\Ember\com\ui\ui::make()->html();
        $buffer->add(\Kwerqy\Ember\com\factory\page_meta\page_meta::make()->build());
        call_user_func_array($fn, [&$buffer, $this->controller, $this]);

        //see if this is a panel request
        if(\Kwerqy\Ember\com\http\http::is_panel_request()){
            $html = $buffer->build();
            $html .= \Kwerqy\Ember\com\js\js::get_script();
            $html .= \Kwerqy\Ember\com\js\js::get_domready();
            \Kwerqy\Ember\com\http\http::json($html);
            exit();
        }else{
            $buffer->flush();
        }

    }
    //--------------------------------------------------------------------------------
    /**
     * @param array $controller
     * @param array $options
     * @return view|\mod\intf\standard|static
     */
	public static function make($controller, $options = []) {
		return new static($controller, $options);
	}
    //--------------------------------------------------------------------------------

}
