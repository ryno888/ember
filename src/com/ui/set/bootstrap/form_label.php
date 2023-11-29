<?php

namespace Kwerqy\Ember\com\ui\set\bootstrap;

/**
 * @package mod\ui\set\system
 * @author Ryno Van Zyl
 */
class form_label extends \Kwerqy\Ember\com\ui\intf\component {
	//--------------------------------------------------------------------------------
	// magic
	//--------------------------------------------------------------------------------
	protected function __construct($options = []) {
		// init
		$this->name = "Form Label";
	}
	//--------------------------------------------------------------------------------
	public function build($options = []) {

		$options = array_merge([
			"id" => false,
			"label" => false,

			"required" => false,
		], $options);

		if(!$options["label"]) return "";
		
		$options["@for"] = $options["id"];
		
		$buffer = \Kwerqy\Ember\com\ui\ui::make()->buffer();
		$buffer->label_($options);
			$buffer->span(["*" => $options["label"]]);

			if($options["required"]){
				$buffer->xicon("fa-exclamation-circle", ["@title" => "Required", ".ms-1 fs-8 text-danger" => true]);
				$buffer->xihidden("__required_field_arr[{$options["id"]}]", $options["label"]);
			}

		$buffer->_label($options);
		return $buffer->build();

	}
	//--------------------------------------------------------------------------------
}