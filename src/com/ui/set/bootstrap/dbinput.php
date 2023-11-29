<?php

namespace Kwerqy\Ember\com\ui\set\bootstrap;

/**
 * Class.
 *
 * @author Liquid Edge Solutions
 * @copyright Copyright Kwerqy. All rights reserved.
 */
class dbinput extends \Kwerqy\Ember\com\ui\intf\component {
	//--------------------------------------------------------------------------------
	// fields
	//--------------------------------------------------------------------------------
	protected $dbentry;
	//--------------------------------------------------------------------------------
	// magic
	//--------------------------------------------------------------------------------
	protected function __construct($options = []) {
		// init
		$this->name = "DB Input";
	}
	//--------------------------------------------------------------------------------
	// functions
	//--------------------------------------------------------------------------------
	public function build($options = []) {
		// options
		$options = array_merge([
			"dbentry" => false,
			"field" => false,
			"value" => false,
			"value_option_arr" => [],
			"label" => false,
			"required" => false,
			"label_html" => true,
		], $options);

		$this->dbentry = $options["dbentry"];

		$buffer = \Kwerqy\Ember\com\ui\ui::make()->buffer();
		$buffer->add($this->build_input($options));
		return $buffer->build();
	}
	//--------------------------------------------------------------------------------
	protected function build_input($options) {

		// config
        $field = $options["field"];
        $value = $options["value"] === false ? $this->dbentry->{$field} : $options["value"];

		// label
		if ($options["label"] === false) $options["label"] = $this->dbentry->db->field_arr[$field][0];
		$label = \Kwerqy\Ember\com\str\str::propercase($options["label"]);

		// display input based on db field type
		switch ($this->dbentry->db->field_arr[$field][2]) {

			// select
  			case TYPE_ENUM       :
  				if(!$options["value_option_arr"]) $options["value_option_arr"] = [null => "-- Not Selected --"] + $this->dbentry->db[$field];
  				return \Kwerqy\Ember\com\ui\ui::make()->iselect($field, $options["value_option_arr"], $value, $label, $options);

  			case TYPE_REFERENCE	:
  				$refernce_table = str_replace($this->dbentry->get_prefix()."_ref_", "", $field);
  				if(!$options["value_option_arr"]) $options["value_option_arr"] = [null => "-- Not Selected --"] + \Kwerqy\Ember\Ember::dbt($refernce_table)->select_list();
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
				\Kwerqy\Ember\com\error\error::create("Unsupported DB_x");
				break;
		}
	}
	//--------------------------------------------------------------------------------
}