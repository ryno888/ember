<?php
namespace Kwerqy\Ember\com\solid_classes\settings;

/**
 * @package app\property_set\product_property
 * @author Ryno Van Zyl
 * @copyright Copyright Kwerqy. All rights reserved.
 */

class octoapi_service_url extends \Kwerqy\Ember\com\solid_classes\settings\intf\standard {

	//--------------------------------------------------------------------------------
	public function get_display_name():string {
		return "Octo API Service URL";
	}
	//--------------------------------------------------------------------------------
	public function get_code():string {
		return "SETTING_OCTOAPI_SERVICE_URL";
	}
	//--------------------------------------------------------------------------------
	public function get_key() {
		return "gs1.setting:OCTOAPI_SERVICE_URL";
	}
	//--------------------------------------------------------------------------------
	public function get_data_type() {
		return TYPE_VARCHAR;
	}
    //--------------------------------------------------------------------------------
}
