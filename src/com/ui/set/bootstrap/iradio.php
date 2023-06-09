<?php

namespace Kwerqy\Ember\com\ui\set\bootstrap;

/**
 * @package mod\ui\set\system
 * @author Ryno Van Zyl
 */
class iradio extends \Kwerqy\Ember\com\ui\intf\component {
	//--------------------------------------------------------------------------------
	// magic
	//--------------------------------------------------------------------------------
	protected function __construct($options = []) {
		// init
		$this->name = "Input Checkbox";
	}
	//--------------------------------------------------------------------------------
	public function build($options = []) {

		$options = array_merge([
			"id" => false,
			"label" => false,
			"value" => false,
			"input_options_arr" => [],

			"help" => false,
			"inline" => false,
			"required" => false,

			"valid_feedback" => "",
			"invalid_feedback" => "This field is required",

			"/wrapper" => [],
		], $options);

		$id = $options["id"];
		$label = $options["label"];
		$input_options_arr = $options["input_options_arr"];
		$value = $options["value"];

		if($options["required"]) $options["@required"] = true;
		if(!$options["/wrapper"]) $options["/wrapper"] = [
		    ".custom-control" => true,
		    ".custom-radio" => true,
		    ".custom-control-inline" => $options["inline"]
        ];

		$buffer = \Kwerqy\Ember\com\ui\ui::make()->buffer();
		$buffer->div_([".form-group" => true]);

			$fn_add_checkbox = function($key, $label)use (&$buffer, $options, $id, $value){
				$buffer->div_($options["/wrapper"]);

					$options[".custom-control-input"] = true;
					$options[".mb-2"] = !$options["inline"];
					$options["@id"] = "{$id}_{$key}";
					$options["@name"] = $id;
					$options["@checked"] = ($key === $value);
					$options["@type"] = "radio";
					$buffer->input($options);

					$buffer->label([".custom-control-label" => true, "*" => $label, "@for" => $options["@id"]]);

					$buffer->div([".valid-feedback" => true, "*" => $options["valid_feedback"]]);
					$buffer->div([".invalid-feedback" => true, "*" => $options["invalid_feedback"]]);
				$buffer->_div();
			};

			$buffer->label(["@for" => $id, "*" => $label, ".mr-3" => $options["inline"]]);
			foreach ($input_options_arr as $id => $value) $fn_add_checkbox($id, $value);

			if($options["help"]) $buffer->small(["*" => $options["help"], "@id" => "{$id}Help", ".form-text text-muted" => true]);
		$buffer->_div();

		return $buffer->build();

	}
	//--------------------------------------------------------------------------------
}