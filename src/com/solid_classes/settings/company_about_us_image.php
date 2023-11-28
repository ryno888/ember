<?php
namespace Kwerqy\Ember\com\solid_classes\settings;

/**
 * @package app\property_set\product_property
 * @author Ryno Van Zyl
 * @copyright Copyright Liquid Edge Solutions. All rights reserved.
 */

class company_about_us_image extends \Kwerqy\Ember\com\solid_classes\settings\intf\standard {

	//--------------------------------------------------------------------------------
	public function get_display_name():string {
		return "Company About Us Image";
	}
	//--------------------------------------------------------------------------------
	public function get_code():string {
		return "SETTING_COMPANY_ABOUT_US_IMAGE";
	}
	//--------------------------------------------------------------------------------
	public function get_key() {
		return "gs1.setting:COMPANY_ABOUT_US_IMAGE";
	}
	//--------------------------------------------------------------------------------
	public function get_data_type() {
		return TYPE_FILE;
	}
	//--------------------------------------------------------------------------------
    public function parse($mixed, $options = []) {
        $value = parent::parse($mixed);
        if(!$value || isnull($value)) return $this->get_default();

        return $value;
    }
    //--------------------------------------------------------------------------------
	public function get_default() {
        return "null";
    }
    //--------------------------------------------------------------------------------
}