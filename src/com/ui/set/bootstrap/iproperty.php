<?php

namespace Kwerqy\Ember\com\ui\set\bootstrap;

/**
 * Class.
 *
 * @author Liquid Edge Solutions
 * @copyright Copyright Kwerqy. All rights reserved.
 */
class iproperty extends \Kwerqy\Ember\com\ui\intf\component {
	//--------------------------------------------------------------------------------
	// fields
	//--------------------------------------------------------------------------------
	protected static $is_singleton = true;

	/**
	 * @var \Kwerqy\Ember\com\solid_classes\intf\dbrow
	 */
	protected $solid;

	protected $dbentry;

	//--------------------------------------------------------------------------------
	// magic
	//--------------------------------------------------------------------------------
	protected function __construct($options = []) {
		// init
		$this->name = "DB Property Solid input";
	}
	//--------------------------------------------------------------------------------
	// functions
	//--------------------------------------------------------------------------------
	public function build($options = []) {
		// options
		$options = array_merge([
			"dbentry" => false,
			"key" => false,
			"value" => false,
			"value_option_arr" => [],
			"label" => false,
			"required" => false,
			"label_html" => true,
		], $options);

		$this->dbentry = $options["dbentry"];
		$this->solid = \Kwerqy\Ember\com\solid_classes\solid::get_instance($options["key"]);

		if($options["value"] === false && property_exists($this->dbentry, "id") && $this->dbentry->id) $options["value"] = $this->dbentry->get_prop($options["key"]);

		$buffer = \Kwerqy\Ember\com\ui\ui::make()->buffer();
		$buffer->xihidden("{$this->dbentry->get_property_table()}[{$this->solid->get_form_id()}]", $this->solid->get_key());
		$buffer->add($this->build_input($options));

		return $buffer->build();
	}
	//--------------------------------------------------------------------------------
	protected function build_input($options) {

		// config
        $field = $this->solid->get_form_id();
        $value = $this->solid->parse($options["value"]);

		// label
		if ($options["label"] === false) $options["label"] = ucfirst($this->solid->get_display_name());
		$label = ucfirst($options["label"]);

		// display input based on db field type
		switch ($this->solid->get_data_type()) {

			// select
  			case TYPE_ENUM       :
  				if(!$options["value_option_arr"]) $options["value_option_arr"] = [null => "-- Not Selected --"] + $this->solid->get_data_arr();
  				return \Kwerqy\Ember\com\ui\ui::make()->iselect($field, $options["value_option_arr"], $value, $label, $options);
  			case TYPE_BOOL       : return \Kwerqy\Ember\com\ui\ui::make()->iradio($field, [0 => "No", 1 => "Yes"], $value ? 1 : 0, $label, $options);

			// date
  			case TYPE_DATE		: return \Kwerqy\Ember\com\ui\ui::make()->idate($field, $value, $label, $options);
			case TYPE_DATETIME	: return \Kwerqy\Ember\com\ui\ui::make()->idate($field, $value, $label, $options);

			case TYPE_INT 		:
  				if($value == 0) $value = false;
				return \Kwerqy\Ember\com\ui\ui::make()->icounter($field, $value, array_merge(["limit" => "numeric", "label" => $label, "@placeholder" => "0"], $options));

  			case TYPE_FLOAT 		:
  				if($value == 0) $value = false;
				return \Kwerqy\Ember\com\ui\ui::make()->itext($field, $value, $label, array_merge(["limit" => "fraction", "@placeholder" => "0"], $options));

  			case TYPE_STRING 	:
  			case TYPE_VARCHAR 	: return \Kwerqy\Ember\com\ui\ui::make()->itext($field, $value, $label, $options);

			case TYPE_EMAIL		: return \Kwerqy\Ember\com\ui\ui::make()->itext($field, $value, $label, array_merge(["limit" => "email"], $options));
  			case TYPE_TELNR 	: return \Kwerqy\Ember\com\ui\ui::make()->itext($field, ($value == "  " ? false : $value), $label, array_merge([".ui-itel" => true], $options));
  			
  			case TYPE_TEXT 		:
  				return \Kwerqy\Ember\com\ui\ui::make()->itext($field, $value, $label, array_merge(["rows" => 5], $options));

  			case TYPE_HTML 		:
  			    if(!isset($options["wysiwyg"]))$options["wysiwyg"] = true;
  			    $options["allow_tag_arr"] = ["a", "iframe"];
  				return \Kwerqy\Ember\com\ui\ui::make()->itext($field, $value, $label, array_merge(["rows" => 5], $options));

  			case TYPE_CURRENCY :
  				if($value == 0) $value = false;
				if ($value != "0.0") {
					if (preg_match("/^\\./i", $value)) $value = "0{$value}";
					if (preg_match("/\\.[0-9]*0$/i", $value)) $value = rtrim($value, "0");
					if (preg_match("/\\.$/i", $value)) $value = rtrim($value, ".");
				}
				else $value = "0";

				return \Kwerqy\Ember\com\ui\ui::make()->itext($field, $value, $label, array_merge(["limit" => "fraction"], $options));

			// unknown
  			default :
				\Kwerqy\Ember\com\error\error::create("Unsupported DB_x ( {$this->solid->get_data_type()} )");
				break;
		}
	}
	//--------------------------------------------------------------------------------
}