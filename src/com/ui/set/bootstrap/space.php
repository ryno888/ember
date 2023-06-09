<?php

namespace Kwerqy\Ember\com\ui\set\bootstrap;

/**
 * @package mod\ui\set\system
 * @author Ryno Van Zyl
 */
class space extends \Kwerqy\Ember\com\ui\intf\component {
	//--------------------------------------------------------------------------------
	// fields
	//--------------------------------------------------------------------------------
	protected static $is_singleton = true;
	//--------------------------------------------------------------------------------
	// magic
	//--------------------------------------------------------------------------------
	protected function __construct($options = []) {
		// init
		$this->name = "Space";
	}
	//--------------------------------------------------------------------------------
	// functions
	//--------------------------------------------------------------------------------
	public function build($options = []) {
		// public static function space($height = 10, $options = []) {

		// options
		$options = array_merge([
			"height" => false,

			"#line-height" => false,
			"#height" => false,
		], $options);

		// init
		$options["#line-height"] = "{$options["height"]}px";
		$options["#height"] = "{$options["height"]}px";

		// done
		return \Kwerqy\Ember\com\ui\ui::make()->tag()->div("*&nbsp;", $options);
	}
	//--------------------------------------------------------------------------------
}