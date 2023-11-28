<?php
namespace Kwerqy\Ember\com\solid_classes\product_property;

/**
 * @package app\property_set\product_property
 * @author Ryno Van Zyl
 * @copyright Copyright Liquid Edge Solutions. All rights reserved.
 */

class size_type extends \Kwerqy\Ember\com\solid_classes\intf\dbrow {

	//--------------------------------------------------------------------------------
	public function get_display_name(): string {
		return "Size Type";
	}
	//--------------------------------------------------------------------------------
	public function get_code(): string {
		return "PRODUCT_PROPERTY_SIZE_TYPE";
	}
	//--------------------------------------------------------------------------------
	public function get_key(): string {
		return "gs1.product:descriptiveSize";
	}
	//--------------------------------------------------------------------------------
	public function get_data_type() {
		return TYPE_VARCHAR;
	}
	//--------------------------------------------------------------------------------
}
