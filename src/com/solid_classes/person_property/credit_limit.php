<?php
namespace Kwerqy\Ember\com\solid_classes\person_property;

/**
 * @package app\property_set\solid_classes\person
 * @author Ryno Van Zyl
 * @copyright Copyright Kwerqy. All rights reserved.
 */

class credit_limit extends \Kwerqy\Ember\com\solid_classes\intf\dbrow {

	//--------------------------------------------------------------------------------
	public function get_display_name() : string {
		return "Credit Limit";
	}
	//--------------------------------------------------------------------------------
	public function get_code() : string {
		return "PERSON_PROPERTY_CREDIT_LIMIT";
	}
	//--------------------------------------------------------------------------------
	public function get_key() : string {
		return "gs1.person.property:CREDIT_LIMIT";
	}
	//--------------------------------------------------------------------------------
	public function get_data_type() {
		TYPE_FLOAT;
	}
	//--------------------------------------------------------------------------------
}
