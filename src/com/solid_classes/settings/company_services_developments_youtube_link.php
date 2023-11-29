<?php
namespace Kwerqy\Ember\com\solid_classes\settings;

/**
 * @package app\property_set\product_property
 * @author Ryno Van Zyl
 * @copyright Copyright Kwerqy. All rights reserved.
 */

class company_services_developments_youtube_link extends \Kwerqy\Ember\com\solid_classes\settings\intf\standard {

	//--------------------------------------------------------------------------------
	public function get_display_name():string {
		return "Developments Youtube Link";
	}
	//--------------------------------------------------------------------------------
	public function get_code():string {
		return "SETTING_COMPANY_SERVICES_DEVELOPMENTS_YOUTUBE_LINK";
	}
	//--------------------------------------------------------------------------------
	public function get_key() {
		return "gs1.setting:COMPANY_SERVICES_DEVELOPMENTS_YOUTUBE_LINK";
	}
	//--------------------------------------------------------------------------------
	public function get_data_type() {
		return TYPE_VARCHAR;
	}
    //--------------------------------------------------------------------------------
}
