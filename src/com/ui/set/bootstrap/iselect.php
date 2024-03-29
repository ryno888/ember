<?php

namespace Kwerqy\Ember\com\ui\set\bootstrap;

/**
 * @package mod\ui\set\system
 * @author Ryno Van Zyl
 */
class iselect extends \Kwerqy\Ember\com\ui\intf\component {
	//--------------------------------------------------------------------------------
	// magic
	//--------------------------------------------------------------------------------
	protected function __construct($options = []) {
		// init
		$this->name = "Input Select";
	}
	//--------------------------------------------------------------------------------
	public function build($options = []) {

		$options = array_merge([
			"id" => false,
			"label" => false,
			"value" => false,
			"value_options_arr" => [],

			"help" => false,
			"required" => false,

			".form-control" => true,

			"valid_feedback" => "",
			"invalid_feedback" => "This field is required",
			
			"/label" => [],
		], $options);

		$id = $options["id"];
		$label = $options["label"];
		$value = $options["value"];

		if($options["required"]) $options["@required"] = true;

		$buffer = \Kwerqy\Ember\com\ui\ui::make()->buffer();

		//input only
		if(!$label && !$options["help"]){
		    $this->_build_input($buffer, $id, $value, $options);
		    return $buffer->build();
        }

		//form group
		$buffer->div_([".form-group" => true]);

			//label
			$options["/label"]["required"] = $options["required"];
			if($label) $buffer->xform_label($label, $id, $options["/label"]);

			$this->_build_input($buffer, $id, $value, $options);

			$buffer->div([".valid-feedback" => true, "*" => $options["valid_feedback"]]);
			$buffer->div([".invalid-feedback" => true, "*" => $options["invalid_feedback"]]);

			if($options["help"]) $buffer->small(["*" => $options["help"], "@id" => "{$id}Help", ".form-text text-muted" => true]);
			if($options["required"]) $buffer->xihidden("__required_field_arr[{$options["id"]}]", $label);

		$buffer->_div();

		return $buffer->build();

	}
	//--------------------------------------------------------------------------------
    private function _build_input(&$buffer, $id, $value, $options){
	    $options["@id"] = $id;
        $options["@name"] = $id;

        $buffer->select_($options);

            foreach ($options["value_options_arr"] as $index => $label){

                $option_options = [];
                $option_options["*"] = $label;
                $option_options["@value"] = $index;
                $option_options["@selected"] = $index == $value;

                $buffer->option($option_options);
            }

        $buffer->_select();
    }
	//--------------------------------------------------------------------------------
}