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
		if(\Kwerqy\Ember\Ember::get_environment() != "development") return null;


		$buffer = \Kwerqy\Ember\com\ui\ui::make()->buffer();
		if(file_exists(DIR_TEMP."/console.txt")){
			$buffer->div_(["#position" => "fixed", "#left" => "0", "#bottom" => "0", "#padding" => "10px", "#background" => "lightgray", ".debug-wrapper" => true]);
				$buffer->xbutton("view", "$('.debug-wrapper').remove(); window.open('".\Kwerqy\Ember\com\http\http::build_action_url("xdev/vview_error")."', '_blank');", [".btn-sm mw-100px me-2" => true]);
				$buffer->xbutton("clear", \Kwerqy\Ember\com\js\js::ajax(\Kwerqy\Ember\com\http\http::build_action_url("xdev/xclear_debug"), [
					"*no_overlay" => true,
					"*data" => ["close_window" => \Kwerqy\Ember\com\http\http::get_control() == "xdev/vview_error"],
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