<?php
namespace Kwerqy\Ember\com\solid_classes\person_property;

/**
 * @package app\property_set\solid_classes\person
 * @author Ryno Van Zyl
 * @copyright Copyright Kwerqy. All rights reserved.
 */

class map_str extends \Kwerqy\Ember\com\solid_classes\intf\dbrow {

	//--------------------------------------------------------------------------------
	public function get_display_name() : string {
		return "Map String";
	}
	//--------------------------------------------------------------------------------
	public function get_code() : string {
		return "PERSON_PROPERTY_MAP_STR";
	}
	//--------------------------------------------------------------------------------
	public function get_key() : string {
		return "gs1.person.property:map:str";
	}
	//--------------------------------------------------------------------------------
	public function get_data_type() {
		TYPE_HTML;
	}
    //--------------------------------------------------------------------------------
}
