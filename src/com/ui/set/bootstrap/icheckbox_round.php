<?php

namespace Kwerqy\Ember\com\ui\set\bootstrap;

/**
 * @package mod\ui\set\system
 * @author Ryno Van Zyl
 */
class icheckbox_round extends \Kwerqy\Ember\com\ui\intf\component {
	//--------------------------------------------------------------------------------
	// magic
	//--------------------------------------------------------------------------------
	protected function __construct($options = []) {
		// init
		$this->name = "Round Checkbox";
	}
	//--------------------------------------------------------------------------------
	public function build($options = []) {

		// options
		$options = array_merge([
		    "id" => false,
		    "checked" => false,
		    "color" => false,
		    "value" => false,
		    "label" => false,
		], $options);

		$id = $options["id"];
		$checked = $options["checked"];
		$label = $options["label"];
		$value = $options["value"];
		$color = $options["color"];
		
		if(!$value) $value = $id;

		// html
		$buffer = \Kwerqy\Ember\com\ui\ui::make()->buffer();
		
        $buffer->div_([".d-flex align-items-center" => true]);

            $options[".round-checkbox-wrapper"] = true;
            $options[".round-checkbox-{$color}"] = $color;
            $options[".round-checkbox-wrapper-sm"] = true;

            $buffer->div_($options);
                $buffer->input(["@type" => "checkbox", "@checked" => $checked, "@id" => $id, "@value" => $value]);
                $buffer->label(["@for" => $id]);
            $buffer->_div();
            if($options["label"]) $buffer->label(["@for" => $id, ".ms-2 cursor-pointer" => true, "*" => $options["label"]]);
        $buffer->_div();
        
		return $buffer->get_clean();

	}
	//--------------------------------------------------------------------------------
}