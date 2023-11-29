<?php
namespace Kwerqy\Ember\com\solid_classes\settings;

/**
 * @package app\property_set\product_property
 * @author Ryno Van Zyl
 * @copyright Copyright Kwerqy. All rights reserved.
 */

class enable_cart extends \Kwerqy\Ember\com\solid_classes\settings\intf\standard {

	//--------------------------------------------------------------------------------
	public function get_display_name():string {
		return "Enable Cart";
	}
	//--------------------------------------------------------------------------------
	public function get_code():string {
		return "SETTING_ENABLE_CART";
	}
	//--------------------------------------------------------------------------------
	public function get_key() {
		return "gs1.setting:ENABLE_CART";
	}
	//--------------------------------------------------------------------------------
	public function get_data_type() {
		return TYPE_BOOL;
	}
	//--------------------------------------------------------------------------------
}
