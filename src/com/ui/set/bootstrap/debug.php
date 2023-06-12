<?php

namespace Kwerqy\Ember\com\ui\set\bootstrap;

/**
 * @package mod\ui\set\system
 * @author Ryno Van Zyl
 */
class debug extends \Kwerqy\Ember\com\ui\intf\component {
	//--------------------------------------------------------------------------------
	// magic
	//--------------------------------------------------------------------------------
	protected function __construct($options = []) {
		// init
		$this->name = "Debug";
	}
	//--------------------------------------------------------------------------------
	public function build($options = []) {

		$options = array_merge([
		], $options);

		if(!file_exists(DIR_TEMP."/console.txt")) return null;
		if(\core::get_environment() != "development") return null;


		$buffer = \Kwerqy\Ember\com\ui\ui::make()->buffer();
		if(file_exists(DIR_TEMP."/console.txt")){
			$buffer->div_(["#position" => "fixed", "#left" => "0", "#bottom" => "0", "#padding" => "10px", "#background" => "lightgray", ".debug-wrapper" => true]);
				$buffer->xbutton("view", "window.open('".\mod\http::build_action_url("ember/vview_error")."', '_blank')", [".btn-sm mw-100px mr-2" => true]);
				$buffer->xbutton("clear", \Kwerqy\Ember\com\js\js::ajax(\mod\http::build_action_url("ember/xclear_debug"), [
					"*data" => ["close_window" => \mod\http::get_control() == "index/vdebug"],
					"*success" => "function(response){
						app.ajax.process_response(response);
					}"
				]), [".btn-sm mw-100px btn-secondary" => true]);
			$buffer->_div();
		}

		return $buffer->build();

	}
	//--------------------------------------------------------------------------------
}