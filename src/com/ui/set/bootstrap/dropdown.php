<?php

namespace Kwerqy\Ember\com\ui\set\bootstrap;

/**
 * @package mod\ui\set\system
 * @author Ryno Van Zyl
 */
class dropdown extends \Kwerqy\Ember\com\ui\intf\component {
	//--------------------------------------------------------------------------------
	// fields
	//--------------------------------------------------------------------------------
	protected $label;
	protected $item_arr = [];
	//--------------------------------------------------------------------------------
	// magic
	//--------------------------------------------------------------------------------
	protected function __construct($options = []) {
		// init
		$this->name = "Dropdown";
		$this->id = \Kwerqy\Ember\com\str\str::generate_id(["prefix" => "dropdown"]);
	}
	//--------------------------------------------------------------------------------
	public function add_link($href, $label, $options = []) {
		$this->item_arr[] = array_merge( [
			"label" => $label,
			"@href" => $href,
			"icon" => false,
			"type" => "link",
		], $options);
	}
	//--------------------------------------------------------------------------------
	public function add_button($label, $onclick = "void", $options = []) {
		$this->item_arr[] = array_merge( [
			"label" => $label,
			"@href" => "javascript:{$onclick};",
			"icon" => false,
			"type" => "link",
		], $options);
	}
	//--------------------------------------------------------------------------------
	/**
	 * @param string $label
	 */
	public function set_label(string $label): void {
		$this->label = $label;
	}
	//--------------------------------------------------------------------------------
	public function build($options = []) {

		$options = array_merge([
		    "id" => $this->id,
		    "label" => $this->label,
		    "icon" => false,
		    "space" => 20,
		    "fn_link" => false,
		    "wrapper_element" => "div",
		    "/dropdown" => [".dropdown no-arrow d-inline-block" => true],
		    "/dropdown-menu" => [".shadow dropdown-menu-right" => true],
		    "/link" => [],
		], $options);

		$id = $options["id"];

		$buffer = \Kwerqy\Ember\com\ui\ui::make()->buffer();
		$buffer->{"{$options["wrapper_element"]}_"}($options["/dropdown"]);

			if(!$options["fn_link"]){
				$link = $options["/link"];
				$link["@href"] = "#";
				$link[".dropdown-toggle"] = true;
				$link["@id"] = $id;
				$link["@role"] = "button";
				$link["@data-bs-toggle"] = "dropdown";
				$link["@aria-expanded"] = "false";
				$link["icon"] = $options["icon"];
				if(!$options["label"]) $link["/icon"] = [];

				$link = array_merge($link, $options["/link"]);

				$buffer->xlink("#", $options["label"] ? $options["label"] : "", $link);
			}else{
				call_user_func_array($options["fn_link"], [$buffer, $options, $this]);
			}

			$options["/dropdown-menu"][".dropdown-menu"] = true;
			$options["/dropdown-menu"]["@aria-labelledby"] = $this->id;
			$buffer->div_($options["/dropdown-menu"]);

				$fn_add_link = function($href, $label, $options = []) use(&$buffer){
					$options[".dropdown-item"] = true;
					$buffer->xlink($href, $label, $options);
				};

				foreach ($this->item_arr as $item){
					switch ($item['type']){
						case "link": $fn_add_link($item["@href"], $item["label"], $item);
					}
				}

			$buffer->_div();

		$buffer->{"_{$options["wrapper_element"]}"}();

		return $buffer->build();

	}
	//--------------------------------------------------------------------------------
}