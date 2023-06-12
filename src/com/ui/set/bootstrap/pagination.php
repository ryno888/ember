<?php

namespace Kwerqy\Ember\com\ui\set\bootstrap;

/**
 * @package mod\ui\set\system
 * @author Ryno Van Zyl
 */
class pagination extends \Kwerqy\Ember\com\ui\intf\component {
	//--------------------------------------------------------------------------------
	// magic
	//--------------------------------------------------------------------------------
	protected function __construct($options = []) {
        parent::__construct($options);

        $options = array_merge([
            "id" => \Kwerqy\Ember\com\str\str::generate_id(["prefix" => "component"])
        ], $options);

        $this->name = "Pagination";
        $this->id = $options["id"];

    }

    //--------------------------------------------------------------------------------
	public function build($options = []) {

		// options
		$options = array_merge([
		    "id" => $this->id,
		    "*total" => 200,
		    "*page" => 1,
		    "*maxVisible" => 5,
		    "*firstLastUse" => true,

		    "*next" => \Kwerqy\Ember\com\ui\ui::make()->icon("fa-angle-right"),
		    "*prev" => \Kwerqy\Ember\com\ui\ui::make()->icon("fa-angle-left"),

		    "*first" => \Kwerqy\Ember\com\ui\ui::make()->icon("fa-angle-double-left"),
		    "*last" => \Kwerqy\Ember\com\ui\ui::make()->icon("fa-angle-double-right"),

		    "!click" => "function(page){}",

		    "*wrapClass" => "ui-pagination",
		    "*activeClass" => false,
		    "*disabledClass" => false,
		    "*nextClass" => false,
		    "*prevClass" => false,
		    "*lastClass" => false,
		    "*firstClass" => false,

		], $options);

		$buffer = \Kwerqy\Ember\com\ui\ui::make()->buffer();

		//init element
		$buffer->div(["@id" => $options["id"]]);

		//init json options
		$json_options = \Kwerqy\Ember\com\js\js::create_options($options);

		//apply script
		\Kwerqy\Ember\com\js\js::add_script("
		    $('#{$options["id"]}').bootpag($json_options).on('page', function(event, num){
		        var fn = {$options["!click"]};
                if (fn) fn.apply(this, [num]);
            });
		");

		// done
		return $buffer->get_clean();

	}
	//--------------------------------------------------------------------------------
}