<?php

namespace Kwerqy\Ember\com\ui\set\bootstrap;

/**
 * @package mod\ui\set\system
 * @author Ryno Van Zyl
 */
class navbar extends \Kwerqy\Ember\com\ui\intf\component {

	//--------------------------------------------------------------------------------
	// properties
	//--------------------------------------------------------------------------------
	public $id;
	public $item_arr = [];
	public $buffer = false;
	public $type = "standard";
	public $brand_html;
	//--------------------------------------------------------------------------------
	// magic
	//--------------------------------------------------------------------------------
	public function __construct($options = []) {

		$options = array_merge([
		    "id" => \Kwerqy\Ember\com\str\str::generate_id(["prefix" => "navbar"]),
		    "type" => "standard",
		], $options);

		// init
		$this->id = $options["id"];
        $this->name = "Navbar";
		$this->type = $options["type"];
		$this->buffer = \Kwerqy\Ember\com\ui\ui::make()->buffer();

	}
	//--------------------------------------------------------------------------------
    public function set_brand_html($mixed) {
        if(is_string($mixed)) $this->brand_html = $mixed;
        else if(is_callable($mixed)) $this->brand_html = $mixed();
    }
	//--------------------------------------------------------------------------------
	/**
	 * @param $label
	 * @param false $link
	 * @param array $options
	 * @param array $options[icon] = fa-times
	 * @param array $options[type] = link | dropdown | dropdown_menu
	 * @return bool
	 */
	public function add_item($label, $link = false, $options = []) {
		// options
		$options = array_merge([
			"icon" => false,
			"auth" => false,
		], $options);

		// sub menu item
		$label_arr = explode("|", $label);
		$count = sizeof($label_arr);
		$current_item = &$this->item_arr;

		for ($i = 1; $i <= $count; $i++) {
			$current_label = $label_arr[$i - 1];
			if ($i == $count) {
				// label
				$label_text = $current_label;

				// add item
				$current_item[$current_label] = [
					"label" => $label_text,
					"link" => $link,
					"icon" => $options["icon"],
					"submenu" => [],
					"dropdown_type" => "dropdown",
				];
			}
			else {
				if (!isset($current_item[$current_label])) return false;
				$current_item = &$current_item[$current_label]["submenu"];
			}
		}

		// done
		return true;
	}
	//--------------------------------------------------------------------------------
	public function build($options = []) {

		$options = array_merge([
			"type" => $this->type
		], $options);

		$buffer = \Kwerqy\Ember\com\ui\ui::make()->buffer();
		switch ($options["type"]){
			case "standard": $this->build_standard($buffer, $options); break;
		}

		return $buffer->build();

	}
	//--------------------------------------------------------------------------------
	private function build_standard(&$buffer, $options = []){

		$options = array_merge([
		    "bg_color" => "light",
			".navbar navbar-expand-lg" => true
		], $options);

		$options[".bg-{$options["bg_color"]}"] = true;

        $buffer->nav_([".navbar navbar-expand-lg bg-light" => true, ]);
            $buffer->div_([".container-fluid" => true, ]);

                if($this->brand_html){
                    $buffer->a_([".navbar-brand" => true, "@href" => "#", ]);
                        $buffer->add($this->brand_html);
                    $buffer->_a();
                }

                $buffer->button_([".navbar-toggler" => true, "@type" => "button", "@data-bs-toggle" => "collapse", "@data-bs-target" => "#{$this->id}", "@aria-controls" => $this->id, "@aria-expanded" => "false", "@aria-label" => "Toggle navigation", ]);
                    $buffer->span([".navbar-toggler-icon" => true, ]);
                $buffer->_button();

                $buffer->div_([".collapse navbar-collapse" => true, "@id" => $this->id, ]);
                    $buffer->ul_([".navbar-nav me-auto mb-2 mb-lg-0" => true, ]);

                        $fn_add_li = function($link, $label, $options = []) use(&$buffer){
							$is_dropdown = (bool) $options["submenu"];
                            if(!$is_dropdown){
                                $options[".nav-link"] = true;
                                $buffer->li_([".nav-item" => true]);
                                    $buffer->xlink($link, $label, $options);
                                $buffer->_li();
                            }else{
                                switch ($options["dropdown_type"]){
                                    case "dropdown":
                                        $dropdown = \Kwerqy\Ember\com\ui\ui::make()->dropdown();
                                        $dropdown->set_label($label);
                                        foreach ($options["submenu"] as $submenu){
                                            $dropdown->add_link($submenu["link"], $submenu["label"], $submenu);
                                        }
                                        $options["/link"]["@href"] = "#";
                                        $options["/link"][".nav-link"] = true;
                                        $options["wrapper_element"] = "li";
                                        $options["/dropdown"] = [".nav-item dropdown no-arrow nav-item" => true];
                                        $buffer->add($dropdown->build($options));
                                        break;
                                }
                            }
						};

						foreach ($this->item_arr as $item){
							$fn_add_li($item["link"], $item["label"], $item);
						}
                    $buffer->_ul();
                $buffer->_div();
            $buffer->_div();
        $buffer->_nav();

	}
	//--------------------------------------------------------------------------------
	protected function link(&$html, $item, $level) {
		// target
		$options = [];
		if (preg_match("/^http/i", $item["link"])) $options["@target"] = "_blank";

		// href
		$href = ($item["link"] ? $item["link"] : "#");

		// tab index
		$options["@tabindex"] = ($level ? -1 : false);

		// icon
		$options["icon"] = $item["icon"];
		if (!$level) {
			$options[".nav-link"] = true;
		}
		else $options[".dropdown-item"] = true;

		// html
		$html->xlink($href, $item["label"], $options);
	}
	//--------------------------------------------------------------------------------
}