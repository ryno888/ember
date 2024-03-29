<?php
namespace Kwerqy\Ember\com\solid_classes\settings;

/**
 * @package app\property_set\product_property
 * @author Ryno Van Zyl
 * @copyright Copyright Kwerqy. All rights reserved.
 */

class email_disclaimer extends \Kwerqy\Ember\com\solid_classes\settings\intf\standard {

	//--------------------------------------------------------------------------------
	public function get_display_name():string {
		return "Email Disclaimer";
	}
	//--------------------------------------------------------------------------------
	public function get_code():string {
		return "SETTING_COMPANY_EMAIL_DISCLAIMER";
	}
	//--------------------------------------------------------------------------------
	public function get_key() {
		return "gs1.setting:EMAIL_DISCLAIMER";
	}
	//--------------------------------------------------------------------------------
	public function get_data_type() {
		return TYPE_TEXT;
	}
    //--------------------------------------------------------------------------------
}
