<?php

namespace Kwerqy\Ember\com\ui\set\bootstrap;

/**
 * @package mod\ui\set\system
 * @author Ryno Van Zyl
 */
class image extends \Kwerqy\Ember\com\ui\intf\component {
	//--------------------------------------------------------------------------------
	// magic
	//--------------------------------------------------------------------------------
	protected function __construct($options = []) {
		// init
		$this->name = "Image";
	}
	//--------------------------------------------------------------------------------
	public function build($options = []) {

		$options = array_merge([
			"@src" => false,
		], $options);


		$buffer = \Kwerqy\Ember\com\ui\ui::make()->buffer();
		$buffer->img($options);
		return $buffer->build();

	}
	//--------------------------------------------------------------------------------
}