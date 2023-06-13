<?php

namespace Kwerqy\Ember\com\ui\set\bootstrap;

/**
 * @package mod\ui\set\system
 * @author Ryno Van Zyl
 */
class link extends \Kwerqy\Ember\com\ui\intf\component {
	//--------------------------------------------------------------------------------
	// magic
	//--------------------------------------------------------------------------------
	protected function __construct($options = []) {
		// init
		$this->name = "Link";
	}
	//--------------------------------------------------------------------------------
	public function build($options = []) {

		$options = array_merge([
			"label" => null,
			"@href" => "#",

			"icon" => false,
			"/icon" => [],

			"badge" => false,
			"badge_color" => "badge-danger",
			"/badge" => [],
		], $options);

		if(substr($options["@href"], 0, 1) == "!"){
			$options["@href"] = \mod\http::build_url(substr($options["@href"], 1, strlen($options["@href"])));
		}
		if(substr($options["@href"], 0, 1) == "@"){
			$options["@href"] = \mod\http::build_action_url(substr($options["@href"], 1, strlen($options["@href"])));
		}

		$label = $options["label"];
		if(is_null($label)) $label = $options["@href"];

		if(!$options["/icon"] && $label){
		    $options["/icon"][".me-2"] = true;
        }

		$buffer = \Kwerqy\Ember\com\ui\ui::make()->buffer();

		$buffer->a_($options);
			if($options["icon"]) $buffer->xicon($options["icon"], $options["/icon"]);
			if($label) $buffer->add($label);
			if($options["badge"]) $buffer->span([".badge {$options["badge_color"]} badge-counter" => true, "*" => $options["badge"]]);
		$buffer->_a();

		return $buffer->build();

	}
	//--------------------------------------------------------------------------------
}