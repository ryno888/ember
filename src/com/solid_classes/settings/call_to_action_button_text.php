<?php
namespace Kwerqy\Ember\com\solid_classes\settings;

/**
 * @package app\property_set\product_property
 * @author Ryno Van Zyl
 * @copyright Copyright Kwerqy. All rights reserved.
 */

class call_to_action_button_text extends \Kwerqy\Ember\com\solid_classes\settings\intf\standard {

	//--------------------------------------------------------------------------------
	public function get_display_name():string {
		return "Button Text";
	}
	//--------------------------------------------------------------------------------
	public function get_code():string {
		return "SETTING_CALL_TO_ACTION_BUTTON_TEXT";
	}
	//--------------------------------------------------------------------------------
	public function get_key() {
		return "gs1.setting:CALL_TO_ACTION_BUTTON_TEXT";
	}
	//--------------------------------------------------------------------------------
	public function get_data_type() {
		return TYPE_VARCHAR;
	}
	//--------------------------------------------------------------------------------
	public function get_default() {
        return "";
    }
    //--------------------------------------------------------------------------------
}
