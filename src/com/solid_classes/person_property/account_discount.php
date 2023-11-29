<?php
namespace Kwerqy\Ember\com\solid_classes\person_property;

/**
 * @package app\property_set\solid_classes\person
 * @author Ryno Van Zyl
 * @copyright Copyright Kwerqy. All rights reserved.
 */

class account_discount extends \Kwerqy\Ember\com\solid_classes\intf\dbrow {

	//--------------------------------------------------------------------------------
	public function get_display_name() : string {
		return "Account Discount";
	}
	//--------------------------------------------------------------------------------
	public function get_code() : string {
		return "PERSON_PROPERTY_ACCOUNT_DISCOUNT";
	}
	//--------------------------------------------------------------------------------
	public function get_key() : string {
		return "urn:gs1:gdd:cl:AllowanceChargeTypeCode:DI_PERSON";
	}
	//--------------------------------------------------------------------------------
	public function get_data_type() {
		TYPE_FLOAT;
	}
	//--------------------------------------------------------------------------------
}
