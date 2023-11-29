<?php
namespace Kwerqy\Ember\com\solid_classes\settings;

/**
 * @package app\property_set\product_property
 * @author Ryno Van Zyl
 * @copyright Copyright Kwerqy. All rights reserved.
 */

class mailchimp_api_key extends \Kwerqy\Ember\com\solid_classes\settings\intf\standard {

	//--------------------------------------------------------------------------------
	public function get_display_name():string {
		return "Mailchimp API Key";
	}
	//--------------------------------------------------------------------------------
	public function get_description(): string {
		return implode("\n", [
			"Log into mailchimp account",
			"Go to https://us1.admin.mailchimp.com/account/api",
			"Scroll down and add API key",
		]);
	}
	//--------------------------------------------------------------------------------
	public function get_code():string {
		return "SETTING_MAILCHIMP_API_KEY";
	}
	//--------------------------------------------------------------------------------
	public function get_key() {
		return "gs1.setting:MAILCHIMP_API_KEY";
	}
	//--------------------------------------------------------------------------------
	public function get_data_type() {
		return TYPE_VARCHAR;
	}
	//--------------------------------------------------------------------------------
}
