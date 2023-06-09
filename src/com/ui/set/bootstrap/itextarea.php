<?php

namespace Kwerqy\Ember\com\ui\set\bootstrap;

/**
 * @package mod\ui\set\system
 * @author Ryno Van Zyl
 */
class itextarea extends \Kwerqy\Ember\com\ui\intf\component {
	//--------------------------------------------------------------------------------
	// magic
	//--------------------------------------------------------------------------------
	protected function __construct($options = []) {
		// init
		$this->name = "Input Text Area";
	}
	//--------------------------------------------------------------------------------
	public function build($options = []) {

		$options = array_merge([
			"id" => false,
			"label" => false,
			"value" => false,

			"help" => false,
			"required" => false,

			".form-control" => true,

			"valid_feedback" => "",
			"invalid_feedback" => "This field is required",

			"rows" => 5,
		], $options);

		$id = $options["id"];
		$label = $options["label"];
		$value = $options["value"];

		if($options["required"]) $options["@required"] = true;

		$buffer = \Kwerqy\Ember\com\ui\ui::make()->buffer();

		$buffer->div_([".form-group" => true]);

			$buffer->label(["@for" => $id, "*" => $label]);

			$options["@id"] = $id;
			$options["@name"] = $id;
			$options["@rows"] = $options["rows"];

			$buffer->textarea_($options);
				$buffer->add($value);
			$buffer->_textarea();

			$buffer->div([".valid-feedback" => true, "*" => $options["valid_feedback"]]);
			$buffer->div([".invalid-feedback" => true, "*" => $options["invalid_feedback"]]);

			if($options["help"]) $buffer->small(["*" => $options["help"], "@id" => "{$id}Help", ".form-text text-muted" => true]);


		$buffer->_div();

		return $buffer->build();

	}
	//--------------------------------------------------------------------------------
}