<?php

namespace Kwerqy\Ember\com\ui\set\bootstrap;

/**
 * @package mod\ui\set\system
 * @author Ryno Van Zyl
 *
 * http://ionden.com/a/plugins/ion.rangeSlider/api.html
 *
 */
class irange extends \Kwerqy\Ember\com\ui\intf\component {
	//--------------------------------------------------------------------------------
	// magic
	//--------------------------------------------------------------------------------
	protected function __construct($options = []) {
		// init
		$this->name = "Range Input";
	}
	//--------------------------------------------------------------------------------
	public function build($options = []) {

		$options = array_merge([
			"id" => false,
			"label" => false,
			"value" => false,
			"help" => false,

            "value_from" => 0,
		    "value_to" => 1000,
		    "min" => 0,
		    "max" => 1000,
		    
		    "/" => [],

		], $options);

		$id = $options["id"];
		$label = $options["label"];
		$value = $options["value"];

		$buffer = \Kwerqy\Ember\com\ui\ui::make()->buffer();

		$buffer->div_([".form-group" => true, "@data-source" => "#{$id}", "#display" => "none"]);

			$buffer->label(["@for" => $id, "*" => $label]);

			$options["@id"] = $id;
			$options["@type"] = "text";
			$options["@name"] = $id;
			$options[".js-range-slider"] = true;

            $buffer->input($options);

            $js_options = [];
            $js_options["*type"] = "double";
            $js_options["*min"] = $options["min"];
            $js_options["*max"] = $options["max"];
            $js_options["*from"] = $options["value_from"];
            $js_options["*to"] = $options["value_to"];
            $js_options["*grid"] = "true";
            $js_options["*onStart"] = "!function (data) {}";
            $js_options["*onChange"] = "!function (data) {}";
            $js_options["*onFinish"] = "!function (data) {}";
            $js_options["*onUpdate"] = "!function (data) {}";

            $js_options = \Kwerqy\Ember\com\js\js::create_options(array_merge($js_options, $options["/"]));

            \Kwerqy\Ember\com\js\js::add_script("
                var $id;
                $(function(){
                    let el = $('#$id');
                    $id = el.ionRangeSlider({$js_options}).data('ionRangeSlider');
                    setTimeout(function(){
                        el.parent().fadeIn('fast');
                    }, 250);
                });
            ");

			if($options["help"]) $buffer->small(["*" => $options["help"], "@id" => "{$id}Help", ".form-text text-muted" => true]);


		$buffer->_div();

		return $buffer->build();

	}
	//--------------------------------------------------------------------------------
}