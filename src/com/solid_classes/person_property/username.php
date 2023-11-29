<?php
namespace Kwerqy\Ember\com\solid_classes\person_property;

/**
 * @package app\property_set\product_property
 * @author Ryno Van Zyl
 * @copyright Copyright Kwerqy. All rights reserved.
 */

class username extends \Kwerqy\Ember\com\solid_classes\intf\dbrow {

	//--------------------------------------------------------------------------------
	public function get_display_name() : string {
		return "Username";
	}
	//--------------------------------------------------------------------------------
	public function get_code() : string {
		return "PERSON_PROPERTY_USERNAME";
	}
	//--------------------------------------------------------------------------------
	public function get_key() : string {
		return "gs1.person.property.login:USERNAME";
	}
	//--------------------------------------------------------------------------------
	public function get_data_type() {
		TYPE_STRING;
	}
	//--------------------------------------------------------------------------------
}
