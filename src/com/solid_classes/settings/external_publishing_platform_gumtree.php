<?php
namespace Kwerqy\Ember\com\solid_classes\settings;

/**
 * @package app\property_set\product_property
 * @author Ryno Van Zyl
 * @copyright Copyright Kwerqy. All rights reserved.
 */

class external_publishing_platform_gumtree extends \Kwerqy\Ember\com\solid_classes\settings\intf\standard {

	//--------------------------------------------------------------------------------
	public function get_display_name():string {
		return "Gumtree";
	}
	//--------------------------------------------------------------------------------
	public function get_code():string {
		return "SETTING_EXTERNAL_PUBLISHING_PLATFORM_GUMTREE";
	}
	//--------------------------------------------------------------------------------
	public function get_key() {
		return "external_publishing.platform.gumtree";
	}
	//--------------------------------------------------------------------------------
	public function get_data_type() {
		return TYPE_VARCHAR;
	}
    //--------------------------------------------------------------------------------
}
