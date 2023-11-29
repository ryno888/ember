<?php
namespace Kwerqy\Ember\com\solid_classes\settings;

/**
 * @package app\property_set\product_property
 * @author Ryno Van Zyl
 * @copyright Copyright Kwerqy. All rights reserved.
 */

class terms_and_conditions extends \Kwerqy\Ember\com\solid_classes\settings\intf\standard {

	//--------------------------------------------------------------------------------
	public function get_display_name():string {
		return "Terms & Conditions";
	}
	//--------------------------------------------------------------------------------
	public function get_code():string {
		return "SETTING_TERMS_AND_CONDITIONS";
	}
	//--------------------------------------------------------------------------------
	public function get_key() {
		return "gs1.setting:TERMS_AND_CONDITIONS";
	}
	//--------------------------------------------------------------------------------
	public function get_data_type() {
		return TYPE_TEXT;
	}
    //--------------------------------------------------------------------------------
}
