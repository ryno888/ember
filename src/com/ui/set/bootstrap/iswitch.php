<?php

namespace Kwerqy\Ember\com\ui\set\bootstrap;

/**
 * @package mod\ui\set\system
 * @author Ryno Van Zyl
 */
class iswitch extends \Kwerqy\Ember\com\ui\intf\component {
	//--------------------------------------------------------------------------------
	// magic
	//--------------------------------------------------------------------------------
	protected function __construct($options = []) {
		// init
		$this->name = "Switch";
	}
	//--------------------------------------------------------------------------------
	public function build($options = []) {

		$options = array_merge([
			"id" => false,
			"label" => false,
			"value" => false,

			"help" => false,
			"required" => false,

			"valid_feedback" => "",
			"invalid_feedback" => "This field is required",

			"/wrapper" => [],
		], $options);

		$id = $options["id"];
		$label = $options["label"];
		$value = $options["value"];

		if($options["required"]) $options["@required"] = true;

		$buffer = \Kwerqy\Ember\com\ui\ui::make()->buffer();
        $buffer->div_([".custom-control custom-switch" => true, ]);

            $options["@id"] = $id;
            $options["@name"] = $id;
            $options["@checked"] = $value;
            $options[".custom-control-input"] = true;
            $options["@type"] = "checkbox";
            $buffer->input($options);

            $buffer->label(["@for" => $id, "*" => $label, ".custom-control-label" => true]);
        $buffer->_div();

		return $buffer->build();

	}
	//--------------------------------------------------------------------------------
}