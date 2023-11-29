<?php
namespace Kwerqy\Ember\com\solid_classes\settings;

/**
 * @package app\property_set\product_property
 * @author Ryno Van Zyl
 * @copyright Copyright Kwerqy. All rights reserved.
 */

class bs_dark extends \Kwerqy\Ember\com\solid_classes\settings\intf\standard {

	//--------------------------------------------------------------------------------
	public function get_display_name():string {
		return "Bootstrap Dark Color";
	}
	//--------------------------------------------------------------------------------
	public function get_code():string {
		return "SETTING_BS_DARK";
	}
	//--------------------------------------------------------------------------------
	public function get_key() {
		return "gs1.setting:BS_DARK";
	}
	//--------------------------------------------------------------------------------
	public function get_data_type() {
		return TYPE_VARCHAR;
	}
	//--------------------------------------------------------------------------------
	public function get_default() {
		return "#212529";
	}
	//--------------------------------------------------------------------------------
}
