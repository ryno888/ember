<?php
namespace Kwerqy\Ember\com\solid_classes\settings;

/**
 * @package app\property_set\product_property
 * @author Ryno Van Zyl
 * @copyright Copyright Kwerqy. All rights reserved.
 */

class external_publishing_platform_enable_gumtree extends \Kwerqy\Ember\com\solid_classes\settings\intf\standard {

	//--------------------------------------------------------------------------------
	public function get_display_name():string {
		return "Enable Gumtree Platform";
	}
	//--------------------------------------------------------------------------------
	public function get_code():string {
		return "SETTING_EXTERNAL_PUBLISHING_PLATFORM_ENABLE_GUMTREE";
	}
	//--------------------------------------------------------------------------------
	public function get_key() {
		return "gs1.setting:EXTERNAL_PUBLISHING_PLATFORM_ENABLE_GUMTREE";
	}
	//--------------------------------------------------------------------------------
	public function get_data_type() {
		return TYPE_BOOL;
	}
    //--------------------------------------------------------------------------------
}
