<?php
namespace Kwerqy\Ember\com\solid_classes\settings;

/**
 * @package app\property_set\product_property
 * @author Ryno Van Zyl
 * @copyright Copyright Liquid Edge Solutions. All rights reserved.
 */

class company_tellnr_work extends \Kwerqy\Ember\com\solid_classes\settings\intf\standard {

	//--------------------------------------------------------------------------------
	public function get_display_name():string {
		return "Company Work #";
	}
	//--------------------------------------------------------------------------------
	public function get_code():string {
		return "SETTING_COMPANY_TELLNR_WORK";
	}
	//--------------------------------------------------------------------------------
	public function get_key() {
		return "gs1.setting:COMPANY_TELLNR_WORK";
	}
	//--------------------------------------------------------------------------------
	public function get_data_type() {
		return TYPE_VARCHAR;
	}
	//--------------------------------------------------------------------------------
	public function get_default() {
        return getenv("ember.tell.nr.contact");
    }
    //--------------------------------------------------------------------------------
}
