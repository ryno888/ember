<?php

namespace Kwerqy\Ember\com\ui\set\bootstrap;

/**
 * @package mod\ui\set\system
 * @author Ryno Van Zyl
 */
class toolbar extends \Kwerqy\Ember\com\ui\intf\component {

	protected $item_arr = [];

	//--------------------------------------------------------------------------------
	// magic
	//--------------------------------------------------------------------------------
	protected function __construct($options = []) {
		// init
		$this->name = "Toolbar";
	}
	//--------------------------------------------------------------------------------
	public function is_empty() {
	    return !$this->item_arr;
	}
	//--------------------------------------------------------------------------------
	public function add_button($label, $onclick = false, $options = []) {

	    $options = array_merge([
	        "/toolbar_item" => [],
	        "content" => \Kwerqy\Ember\com\ui\ui::make()->button($label, $onclick, $options),
	    ], $options);

		$this->item_arr[] = $options;
	}
	//--------------------------------------------------------------------------------
	public function add_link($label, $href = "#", $options = []) {

	    $options = array_merge([
	        "/toolbar_item" => [],
	        "content" => \Kwerqy\Ember\com\ui\ui::make()->link($href, $label, $options),
	    ], $options);

		$this->item_arr[] = $options;
	}
	//--------------------------------------------------------------------------------
	public function add_html($html, $options = []) {

	    $options = array_merge([
	        "/toolbar_item" => [],
	        "content" => !is_string($html) && is_callable($html) ? $html() : $html,
	    ], $options);

		$this->item_arr[] = $options;
	}
	//--------------------------------------------------------------------------------
	public function build($options = []) {

		$options = array_merge([
		    "/toolbar_item" => []
		], $options);


		if(!$this->item_arr) return "";

		$buffer = \Kwerqy\Ember\com\ui\ui::make()->buffer();

		$buffer->div_([".ui-toolbar d-flex flex-wrap" => true]);
		    $last_index = \Kwerqy\Ember\com\arr\arr::get_last_index($this->item_arr);
		    foreach ($this->item_arr as $index => $item){
                $item["/toolbar_item"] = array_merge($item["/toolbar_item"], $options["/toolbar_item"]);
		        $item["/toolbar_item"][".ui-toolbar-item d-flex"] = true;
		        $item["/toolbar_item"][".me-2"] = $index != $last_index;
		        $buffer->div_($item["/toolbar_item"]);
                    $buffer->add($item["content"]);
                $buffer->_div();

            }
	    $buffer->_div();

		return $buffer->build();

	}
	//--------------------------------------------------------------------------------
}