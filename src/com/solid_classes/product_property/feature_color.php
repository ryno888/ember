<?php
namespace Kwerqy\Ember\com\solid_classes\product_property;

/**
 * @package app\solid\property_set\solid_classes\listing_property
 * @author Ryno Van Zyl
 * @copyright Copyright Liquid Edge Solutions. All rights reserved.
 */

class feature_color extends \Kwerqy\Ember\com\solid_classes\intf\dbrow {

	//--------------------------------------------------------------------------------
	public function get_display_name(): string {
		return "Feature Color";
	}
	//--------------------------------------------------------------------------------
	public function get_code(): string {
		return "PRODUCT_PROPERTY_FEATURE_COLOR";
	}
	//--------------------------------------------------------------------------------
	public function get_key(): string {
		return "gs1.product:FEATURE";
	}
	//--------------------------------------------------------------------------------
	public function get_data_arr(): array {
		return \Kwerqy\Ember\com\ui\ui::$bootstrap_color_arr;
	}
	//--------------------------------------------------------------------------------
	public function get_data_type() {
		return TYPE_ENUM;
	}
    //--------------------------------------------------------------------------------
}
