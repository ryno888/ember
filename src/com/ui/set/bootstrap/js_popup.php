<?php

namespace Kwerqy\Ember\com\ui\set\bootstrap;

/**
 * Class.
 *
 * @author Liquid Edge Solutions
 * @copyright Copyright Liquid Edge Solutions. All rights reserved.
 */
class js_popup extends \Kwerqy\Ember\com\ui\intf\component {
	//--------------------------------------------------------------------------------
	// properties
	//--------------------------------------------------------------------------------
	//--------------------------------------------------------------------------------
	// magic
	//--------------------------------------------------------------------------------
	public function __construct($options = []) {

		// init
        $this->name = "JS Popup";

	}
	//--------------------------------------------------------------------------------
	// functions
	//--------------------------------------------------------------------------------
	public function build($options = []) {
        $options = array_merge([
            "url" => false,
            "fullscreen" => false,
            "panel" => \Kwerqy\Ember\Ember::$panel,

            "*class" => null,
            "*height_class" => false,
            "*width" => "modal-lg",
            "*title" => "Alert",
            "*hide_header" => false,
            "*hide_footer" => true,
            "*enable_loading_content" => true,
            "*closable" => true,
            "*backdrop" => "static", // true | false | 'static'
        ], $options);

        if($options["*hide_header"] && $options["*closable"]){
            $options["*title"] = "";
            $options["*hide_header"] = false;
        }

        if($options["fullscreen"]){
            $options["*width"] = "modal-fullscreen-sm-down";
            $options["*class"] = "my-0";
            $options["*height_class"] = "{$options["*height_class"]} min-vh-100";
        }

        if(!$options["*height_class"]){
            $options["*height_class"] = "min-h-40vh";
        }

        $js_options = \Kwerqy\Ember\com\js\js::create_options($options);

        return "{$options["panel"]}.popup('{$options["url"]}', {$js_options});";
	}
	//--------------------------------------------------------------------------------
}