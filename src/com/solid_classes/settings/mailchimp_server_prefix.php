<?php
namespace Kwerqy\Ember\com\solid_classes\settings;

/**
 * @package app\property_set\product_property
 * @author Ryno Van Zyl
 * @copyright Copyright Liquid Edge Solutions. All rights reserved.
 */

class mailchimp_server_prefix extends \Kwerqy\Ember\com\solid_classes\settings\intf\standard {

	//--------------------------------------------------------------------------------
	public function get_display_name():string {
		return "Mailchimp Server Prefix";
	}
	//--------------------------------------------------------------------------------
	public function get_description(): string {
		return implode("\n", [
			"Log into mailchimp account",
			"Extract server prefix from URL",
			"IE: https://[SERVER_PREFIX].admin.mailchimp.com/",
			"IE: us7",
		]);
	}
	//--------------------------------------------------------------------------------
	public function get_code():string {
		return "SETTING_MAILCHIMP_SERVER_PREFIX";
	}
	//--------------------------------------------------------------------------------
	public function get_key() {
		return "gs1.setting:MAILCHIMP_SERVER_PREFIX";
	}
	//--------------------------------------------------------------------------------
	public function get_data_type() {
		return TYPE_VARCHAR;
	}
	//--------------------------------------------------------------------------------
}
