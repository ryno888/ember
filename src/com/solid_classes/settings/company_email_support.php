<?php
namespace Kwerqy\Ember\com\solid_classes\settings;

/**
 * @package app\property_set\product_property
 * @author Ryno Van Zyl
 * @copyright Copyright Liquid Edge Solutions. All rights reserved.
 */

class company_email_support extends \Kwerqy\Ember\com\solid_classes\settings\intf\standard {

	//--------------------------------------------------------------------------------
	public function get_display_name():string {
		return "Company Email Support";
	}
	//--------------------------------------------------------------------------------
	public function get_code():string {
		return "SETTING_COMPANY_EMAIL_SUPPORT";
	}
	//--------------------------------------------------------------------------------
	public function get_key() {
		return "gs1.setting:COMPANY_EMAIL_SUPPORT";
	}
	//--------------------------------------------------------------------------------
	public function get_data_type() {
		return TYPE_S;
	}
	//--------------------------------------------------------------------------------
	public function get_default() {
        return getenv("ember.email.contact");
    }
    //--------------------------------------------------------------------------------
}
