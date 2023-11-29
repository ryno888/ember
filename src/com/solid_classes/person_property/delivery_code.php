<?php
namespace Kwerqy\Ember\com\solid_classes\person_property;

/**
 * @package app\property_set\solid_classes\person
 * @author Ryno Van Zyl
 * @copyright Copyright Kwerqy. All rights reserved.
 */

class delivery_code extends \Kwerqy\Ember\com\solid_classes\intf\dbrow {

	//--------------------------------------------------------------------------------
	public function get_display_name() : string {
		return "Delivery Code";
	}
	//--------------------------------------------------------------------------------
	public function get_code() : string {
		return "PERSON_PROPERTY_DELIVERY_CODE";
	}
	//--------------------------------------------------------------------------------
	public function get_key() : string {
		return "gs1.person.property:DELIVERY_CODE";
	}
	//--------------------------------------------------------------------------------
	public function get_data_type() {
		TYPE_STRING;
	}
	//--------------------------------------------------------------------------------
}
