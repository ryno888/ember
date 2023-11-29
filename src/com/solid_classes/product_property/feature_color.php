<?php
namespace Kwerqy\Ember\com\solid_classes\product_property;

/**
 * @package app\solid\property_set\solid_classes\listing_property
 * @author Ryno Van Zyl
 * @copyright Copyright Kwerqy. All rights reserved.
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
		return "gs1.product:FEATURE:COLOR";
	}
	//--------------------------------------------------------------------------------
	public function get_data_arr(): array {

		$return_arr = [];

		array_walk(\Kwerqy\Ember\com\ui\ui::$bootstrap_color_arr, function($color)use(&$return_arr){
			$return_arr[$color] = \Kwerqy\Ember\com\str\str::propercase($color);
		});

		return $return_arr;
	}
	//--------------------------------------------------------------------------------
	public function get_data_type() {
		return TYPE_ENUM;
	}
    //--------------------------------------------------------------------------------
}
