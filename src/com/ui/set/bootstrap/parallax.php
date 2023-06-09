<?php

namespace Kwerqy\Ember\com\ui\set\bootstrap;

/**
 * @package mod\ui\set\system
 * @author Ryno Van Zyl
 */
class parallax extends \Kwerqy\Ember\com\ui\intf\component {
	//--------------------------------------------------------------------------------
	// fields
	//--------------------------------------------------------------------------------

	protected static $is_singleton = true;
	//--------------------------------------------------------------------------------
	// magic
	//--------------------------------------------------------------------------------
	protected function __construct($options = []) {
		// init
		$this->name = "Parallax";
	}
	//--------------------------------------------------------------------------------
	// functions
	//--------------------------------------------------------------------------------
	public function build($options = []) {
		// options

		$options = array_merge([
		    "src" => false,
		    "html" => false,

		    "@data-bss-parallax-bg" => "true",
			"#height" => "100vh",
			"#background-position" => "center",
			"#background-size" => "cover",

			".d-flex justify-content-center align-items-center" => true,

		], $options);

		$options["#background-image"] = "url({$options["src"]})";
		$buffer = \Kwerqy\Ember\com\ui\ui::make()->buffer();

		$buffer->div_($options);
			if($options["html"]){
				$buffer->div_([".d-flex w-100 justify-content-center" => true]);
					$buffer->add(is_callable($options["html"]) ? $options["html"]() : $options["html"]);
				$buffer->_div();
			}
		$buffer->_div();


		return $buffer->build();



	}
	//--------------------------------------------------------------------------------
}