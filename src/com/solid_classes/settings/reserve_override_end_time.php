<?php
namespace Kwerqy\Ember\com\solid_classes\settings;

/**
 * @package app\property_set\product_property
 * @author Ryno Van Zyl
 * @copyright Copyright Kwerqy. All rights reserved.
 */

class reserve_override_end_time extends \Kwerqy\Ember\com\solid_classes\settings\intf\standard {

	//--------------------------------------------------------------------------------
	public function get_display_name():string {
		return "Reserve Override End Time";
	}
	//--------------------------------------------------------------------------------
	public function get_code():string {
		return "SETTING_RESERVE_OVERRIDE_END_TIME";
	}
	//--------------------------------------------------------------------------------
	public function get_key() {
		return "gs1.setting:RESERVE_OVERRIDE_END_TIME";
	}
	//--------------------------------------------------------------------------------
	public function get_data_type() {
		return TYPE_VARCHAR;
	}
	//--------------------------------------------------------------------------------
}
