<?php

namespace Kwerqy\Ember\com\ui\set\bootstrap;

/**
 * @package mod\ui\set\system
 * @author Ryno Van Zyl
 */
class message extends \Kwerqy\Ember\com\ui\intf\component {
	//--------------------------------------------------------------------------------
	// fields
	//--------------------------------------------------------------------------------
	protected static $is_singleton = true;
	//--------------------------------------------------------------------------------
	// magic
	//--------------------------------------------------------------------------------
	protected function __construct($options = []) {
		// init
		$this->name = "Message";
	}
	//--------------------------------------------------------------------------------
	// functions
	//--------------------------------------------------------------------------------
	public function build($options = []) {
		// public static function space($height = 10, $options = []) {

		// options
		$options = array_merge([
			"content" => false,
			"color" => true,
			".alert" => true,
			"@role" => "alert",
			"separator" => "<br>",
			"dismissible" => false,
		], $options);

		if($options["color"]){
		    $options[".alert-{$options["color"]}"] = true;
        }

		// init
		$buffer = \Kwerqy\Ember\com\ui\ui::make()->buffer();

		if($options["dismissible"]){
		    $options[".alert-dismissible"] = true;
		    $options[".fade"] = true;
		    $options[".show"] = true;
        }

        $buffer->div_($options);

            $content = $options["content"];
            if(is_callable($content)) $content = $content();
            if(is_array($content)) $content = implode($options["separator"], $content);
            $buffer->add($content);

            if($options["dismissible"]){
                $buffer->button_(["@type" => "button", ".close" => true, "@data-dismiss" => "alert", "@aria-label" => "Close", ]);
                    $buffer->span(["@aria-hidden" => "true", "*" => "×"]);
                $buffer->_button();
            }

        $buffer->_div();

		// done
		return $buffer->build();
	}
	//--------------------------------------------------------------------------------
}