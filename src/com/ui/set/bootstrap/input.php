<?php

namespace Kwerqy\Ember\com\ui\set\bootstrap;

/**
 * @package mod\ui\set\system
 * @author Ryno Van Zyl
 */
class input extends \Kwerqy\Ember\com\ui\intf\component {
	//--------------------------------------------------------------------------------
	// magic
	//--------------------------------------------------------------------------------
	protected function __construct($options = []) {
		// init
		$this->name = "Input";
	}
	//--------------------------------------------------------------------------------
	public function build($options = []) {

		$options = array_merge([
			"@id" => false,
			"@name" => false,
			"@value" => false,
			"@type" => false,
		], $options);

		if(!$options["@name"]) $options["@name"] = $options["@id"];

		$buffer = \Kwerqy\Ember\com\ui\ui::make()->buffer();
		$buffer->input($options);

		return $buffer->build();

	}
	//--------------------------------------------------------------------------------
}