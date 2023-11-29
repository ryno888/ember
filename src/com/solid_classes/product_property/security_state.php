<?php
namespace Kwerqy\Ember\com\solid_classes\product_property;

/**
 * @package app\property_set\product_property
 * @author Ryno Van Zyl
 * @copyright Copyright Kwerqy. All rights reserved.
 */

class security_state extends \Kwerqy\Ember\com\solid_classes\intf\dbrow {

	//--------------------------------------------------------------------------------
	public function get_display_name(): string {
		return "Security State";
	}
	//--------------------------------------------------------------------------------
	public function get_code(): string {
		return "PRODUCT_PROPERTY_SECURITY_STATE";
	}
	//--------------------------------------------------------------------------------
	public function get_key(): string {
		return "urn:gs1:gdd:cl:productSecureState";
	}
	//--------------------------------------------------------------------------------
	public function get_data_type() {
		return \com\data::TYPE_INT;
	}
	//--------------------------------------------------------------------------------
}
