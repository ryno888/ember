<?php

namespace Kwerqy\Ember\com\ui\set\bootstrap;

/**
 * @package mod\ui\set\system
 * @author Ryno Van Zyl
 */
class button extends \Kwerqy\Ember\com\ui\intf\component {
	//--------------------------------------------------------------------------------
	// magic
	//--------------------------------------------------------------------------------
	protected function __construct($options = []) {
		// init
		$this->name = "Button";
	}
	//--------------------------------------------------------------------------------
	public function build($options = []) {

		$options = array_merge([
			"label" => false,
			"icon" => false,
			"@type" => "button",
			"!click" => false,
            "/icon" => [],
		], $options);

		if($options["icon"] && !$options["/icon"] && $options["label"]){
		    $options["/icon"] = [".me-2" => true];
        }

		if(!is_string($options["label"]) && is_callable($options["label"])){
		    $options["label"] = $options["label"]();
        }

		$buffer = \Kwerqy\Ember\com\ui\ui::make()->buffer();

		switch ($options["@type"]){
			case "link": $this->build_link($buffer, $options); break;

			case "submit":
			case "button": $this->build_button($buffer, $options); break;

			case "button_circle": $this->build_button_circle($buffer, $options); break;
		}

		return $buffer->build();

	}
	//--------------------------------------------------------------------------------
	private function build_button_circle($buffer, $options = []){
		$options = array_merge([
		    "!click" => false,
		    ".btn btn-circle btn-primary" => true,
		    "/icon" => [],
		], $options);

		$buffer->button_($options);
			if($options["icon"]){
				$buffer->xicon($options["icon"], $options["/icon"]);
			}
		$buffer->_button();
	}
	//--------------------------------------------------------------------------------
	private function build_button($buffer, $options = []){
		$options = array_merge([
		    "!click" => false,
		    ".btn btn-primary" => true,
			".btn-icon-split" => (bool) $options["icon"],
		    "/icon" => [],
		], $options);

		if($options["!click"] instanceof offcanvas){
		    $offcanvas = $options["!click"];
		    $options["!click"] = "javascript:;";
		    $options["@data-bs-toggle"] = "offcanvas";
		    $options["@data-bs-target"] = "#{$offcanvas->get_id()}";
		    $options["@aria-controls"] = "offcanvasRight";
		    $options["@type"] = "button";
            $buffer->add($offcanvas->build());
        }

		$buffer->button_($options);
			if($options["icon"]){
				$buffer->span_([".icon" => true]);
					$buffer->xicon($options["icon"], $options["/icon"]);
				$buffer->_span();
			}
			$buffer->span(["*" => $options["label"], ".text" => true]);
		$buffer->_button();
	}
	//--------------------------------------------------------------------------------
	private function build_link(&$buffer, $options = []){

		$options = array_merge([
		    "@href" => "#",
		    ".btn btn-primary" => true,
			".btn-icon-split" => (bool) $options["icon"],
		    "/icon" => [],
		], $options);

		if($options["!click"]) {
//			$options["@href"] = "javascript:{$options["!click"]}";
			$options["@href"] = $options["!click"];
			$options["!click"] = false;
		}

		$buffer->a_($options);
			if($options["icon"]){
				$buffer->span_([".icon" => true]);
					$buffer->xicon($options["icon"], $options["/icon"]);
				$buffer->_span();
			}
			$buffer->span(["*" => $options["label"], ".text" => true]);
		$buffer->_a();
	}
	//--------------------------------------------------------------------------------
}