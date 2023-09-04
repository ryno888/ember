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
		    "*activeClass" => "active",
            "*disabledClass" => "disabled",
            "*nextClass" => "next",
            "*prevClass" => "previous",
            "*lastClass" => "last",
            "*firstClass" => "first",
		    "/wrapper" => [],

		], $options);

		$buffer = \Kwerqy\Ember\com\ui\ui::make()->buffer();

		//init element
        $options["/wrapper"]["@id"] = $options["id"];
		$buffer->div($options["/wrapper"]);

		//init json options
		$json_options = \Kwerqy\Ember\com\js\js::create_options($options);

		//apply script
		\Kwerqy\Ember\com\js\js::add_script("
		    var {$options["id"]} = $('#{$options["id"]}').bootpag($json_options);
		    {$options["id"]}.on('page', function(event, num){
		        var fn = {$options["!click"]};
                if (fn) fn.apply(this, [num]);
            });
            
            {$options["id"]}.update = function(options){
            
                options = $.extend({
                    maxVisible: {$options["*maxVisible"]},
                    total: {$options["*maxVisible"]},
                }, (options === undefined ? {} : options));
            
                {$options["id"]}.bootpag(options);
            }
		");

		// done
		return $buffer->get_clean();

	}
	//--------------------------------------------------------------------------------
}