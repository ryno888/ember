<?php
namespace Kwerqy\Ember\com\solid_classes\settings;

/**
 * @package app\property_set\product_property
 * @author Ryno Van Zyl
 * @copyright Copyright Kwerqy. All rights reserved.
 */

class mailchimp_audience_id extends \Kwerqy\Ember\com\solid_classes\settings\intf\standard {

	//--------------------------------------------------------------------------------
	public function get_display_name():string {
		return "Mailchimp Audience ID";
	}
	//--------------------------------------------------------------------------------
	public function get_description(): string {
		return implode("\n", [
			"Log into mailchimp account",
			"Click Audience.",
			"Click All contacts.",
			"If you have more than one audience, click the Current audience drop-down and choose the one you want to work with.",
			"Click the Settings drop-down and choose Audience name and defaults.",
			"In the Audience ID section, you’ll see a string of letters and numbers. This is your audience ID.",
		]);
	}

	//--------------------------------------------------------------------------------
	public function get_code():string {
		return "SETTING_MAILCHIMP_AUDIENCE_ID";
	}
	//--------------------------------------------------------------------------------
	public function get_key() {
		return "gs1.setting:MAILCHIMP_AUDIENCE_ID";
	}
	//--------------------------------------------------------------------------------
	public function get_data_type() {
		return TYPE_VARCHAR;
	}
	//--------------------------------------------------------------------------------
}
