<?php

namespace Kwerqy\Ember\com\ui\set\bootstrap;

/**
 * @package mod\ui\set\system
 * @author Ryno Van Zyl
 */
class badge extends \Kwerqy\Ember\com\ui\intf\component {
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
			".badge" => true,
			"separator" => "<br>",
		], $options);

		if($options["color"]){
		    $options[".badge-{$options["color"]}"] = true;
        }

		$content = $options["content"];
        if(is_callable($content)) $content = $content();
        if(is_array($content)) $content = implode($options["separator"], $content);
        $options["*"] = $content;

		// done
		return \Kwerqy\Ember\com\ui\ui::make()->tag()->span($options);
	}
	//--------------------------------------------------------------------------------
}