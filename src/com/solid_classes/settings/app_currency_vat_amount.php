<?php
namespace Kwerqy\Ember\com\solid_classes\settings;

/**
 * @package app\property_set\product_property
 * @author Ryno Van Zyl
 * @copyright Copyright Kwerqy. All rights reserved.
 */

class app_currency_vat_amount extends \Kwerqy\Ember\com\solid_classes\settings\intf\standard {

	//--------------------------------------------------------------------------------
	public function get_display_name():string {
		return "VAT Amount";
	}
	//--------------------------------------------------------------------------------
	public function get_code():string {
		return "SETTING_APP_CURRENCY_VAT_AMOUNT";
	}
	//--------------------------------------------------------------------------------
	public function get_key() {
		return "gs1.setting:APP_CURRENCY_VAT_AMOUNT";
	}
	//--------------------------------------------------------------------------------
	public function get_data_type() {
		return TYPE_INT;
	}
	//--------------------------------------------------------------------------------
	public function get_default() {
		return 15;
	}
	//--------------------------------------------------------------------------------
}
