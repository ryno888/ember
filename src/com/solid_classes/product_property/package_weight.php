<?php
namespace Kwerqy\Ember\com\solid_classes\product_property;

/**
 * @package app\property_set\product_property
 * @author Ryno Van Zyl
 * @copyright Copyright Kwerqy. All rights reserved.
 */

class package_weight extends \Kwerqy\Ember\com\solid_classes\intf\dbrow {

	//--------------------------------------------------------------------------------
	public function get_display_name(): string {
		return "Package weight";
	}
	//--------------------------------------------------------------------------------
	public function get_code(): string {
		return "PRODUCT_PROPERTY_PACKAGE_WEIGHT";
	}
	//--------------------------------------------------------------------------------
	public function get_key(): string {
		return "gs1.product.package:weight";
	}
	//--------------------------------------------------------------------------------
	public function get_data_type() {
		return TYPE_FLOAT;
	}
	//--------------------------------------------------------------------------------
	/**
	 * @param $mixed
	 * @return mixed|string
	 */
	public function format($mixed, $options = []){
		return $this->parse($mixed)." kg";
	}
	//--------------------------------------------------------------------------------
}
