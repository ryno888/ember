<?php
namespace Kwerqy\Ember\com\solid_classes\settings;

/**
 * @package app\property_set\product_property
 * @author Ryno Van Zyl
 * @copyright Copyright Liquid Edge Solutions. All rights reserved.
 */

class promotion_voucher_prefix extends \Kwerqy\Ember\com\solid_classes\settings\intf\standard {

	//--------------------------------------------------------------------------------
	public function get_display_name():string {
		return "Promotion Voucher Prefix";
	}
	//--------------------------------------------------------------------------------
	public function get_code():string {
		return "SETTING_PROMOTION_VOUCHER_PREFIX";
	}
	//--------------------------------------------------------------------------------
	public function get_key() {
		return "gs1.setting:PROMOTION_VOUCHER_PREFIX";
	}
	//--------------------------------------------------------------------------------
	public function get_data_type() {
		return TYPE_VARCHAR;
	}
	//--------------------------------------------------------------------------------
}
