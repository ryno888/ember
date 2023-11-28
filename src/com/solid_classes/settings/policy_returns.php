<?php
namespace Kwerqy\Ember\com\solid_classes\settings;

/**
 * @package app\property_set\product_property
 * @author Ryno Van Zyl
 * @copyright Copyright Liquid Edge Solutions. All rights reserved.
 */

class policy_returns extends \Kwerqy\Ember\com\solid_classes\settings\intf\standard {

	//--------------------------------------------------------------------------------
	public function get_display_name():string {
		return "Returns Policy";
	}
	//--------------------------------------------------------------------------------
	public function get_code():string {
		return "SETTING_POLICY_RETURNS";
	}
	//--------------------------------------------------------------------------------
	public function get_key() {
		return "gs1.setting:POLICY_RETURNS";
	}
	//--------------------------------------------------------------------------------
	public function get_data_type() {
		return TYPE_TEXT;
	}
    //--------------------------------------------------------------------------------
}