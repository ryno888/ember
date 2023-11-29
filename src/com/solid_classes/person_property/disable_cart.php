<?php
namespace Kwerqy\Ember\com\solid_classes\person_property;

/**
 * @package app\property_set\solid_classes\person
 * @author Ryno Van Zyl
 * @copyright Copyright Kwerqy. All rights reserved.
 */

class disable_cart extends \Kwerqy\Ember\com\solid_classes\intf\dbrow {

	//--------------------------------------------------------------------------------
	public function get_display_name() : string {
		return "Disable Cart";
	}
	//--------------------------------------------------------------------------------
	public function get_code() : string {
		return "PERSON_PROPERTY_DISABLE_CART";
	}
	//--------------------------------------------------------------------------------
	public function get_key() : string {
		return "gs1.person.property:DISABLE_CART";
	}
	//--------------------------------------------------------------------------------
	public function get_data_type() {
		TYPE_BOOL;
	}
	//--------------------------------------------------------------------------------
}
