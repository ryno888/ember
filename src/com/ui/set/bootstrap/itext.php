<?php

namespace Kwerqy\Ember\com\ui\set\bootstrap;

/**
 * @package mod\ui\set\system
 * @author Ryno Van Zyl
 */
class itext extends \Kwerqy\Ember\com\ui\intf\component {
	//--------------------------------------------------------------------------------
	// magic
	//--------------------------------------------------------------------------------
	protected function __construct($options = []) {
		// init
		$this->name = "Input Text";
	}
	//--------------------------------------------------------------------------------
	public function build($options = []) {

		$options = array_merge([
			"id" => false,
			"label" => false,
			"value" => false,

			"type" => "text",
			"help" => false,
			"prepend" => false,
			"append" => false,
			"required" => false,
			"mask" => false,

			".form-control" => true,

			"valid_feedback" => "",
			"invalid_feedback" => "This field is required",

			"!enter" => false,

			"/label" => [],
		], $options);

		$id = $options["id"];
		$label = $options["label"];
		$value = $options["value"];

		$options["@data-identifier"] = \Kwerqy\Ember\com\str\str::generate_id();

		if($options["required"]) $options["@required"] = true;
		if($options["mask"]) $options["type"] = "password";
		if($options["!enter"]){
		    $options["!keypress"] = "
                var keycode = (event.keyCode ? event.keyCode : event.which);
                if(keycode == '13') {$options["!enter"]};
		    ";
		    unset($options["!enter"]);
        }

		if($options["type"] == "number"){
		    $value = round(\Kwerqy\Ember\com\data\data::parse($value, TYPE_FLOAT), $options["fraction"]);
            if($value == 0) $value = false;
        }

		$buffer = \Kwerqy\Ember\com\ui\ui::make()->buffer();

		if(!$options["prepend"] && !$options["append"] && !$label && !$options["help"]){
		    $buffer->xinput($options["type"], $id, $value, $options);
		    return $buffer->build();
        }


		$buffer->div_([".form-group" => true]);
			
			//label
			$options["/label"]["required"] = $options["required"];
			if($label) $buffer->xform_label($label, $id, $options["/label"]);
			
			$buffer->div_([".input-group mb-2" => $options["prepend"] || $options["append"]]);

				if($options["prepend"]){
					$buffer->div_([".input-group-prepend" => true]);
						$buffer->span([".input-group-text" => true, "*" => $options["prepend"], "@id" => "prepend{$id}"]);
					$buffer->_div();
				}

				$buffer->xinput($options["type"], $id, $value, $options);

				if($options["append"]){
					$buffer->div_([".input-group-append" => true]);
						$buffer->span([".input-group-text" => true, "*" => $options["append"], "@id" => "append{$id}"]);
					$buffer->_div();
				}

				$buffer->div([".valid-feedback" => true, "*" => $options["valid_feedback"]]);
				$buffer->div([".invalid-feedback" => true, "*" => $options["invalid_feedback"]]);

			$buffer->_div();
			if($options["help"]) $buffer->small(["*" => $options["help"], "@id" => "{$id}Help", ".form-text text-muted" => true]);


		$buffer->_div();


		return $buffer->build();

	}
	//--------------------------------------------------------------------------------
}