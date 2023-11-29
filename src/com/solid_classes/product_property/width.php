<?php
namespace Kwerqy\Ember\com\solid_classes\product_property;

/**
 * @package app\property_set\product_property
 * @author Ryno Van Zyl
 * @copyright Copyright Kwerqy. All rights reserved.
 */

class width extends \Kwerqy\Ember\com\solid_classes\intf\dbrow {

	//--------------------------------------------------------------------------------
	public function get_display_name(): string {
		return "Width";
	}
	//--------------------------------------------------------------------------------
	public function get_code(): string {
		return "PRODUCT_PROPERTY_WIDTH";
	}
	//--------------------------------------------------------------------------------
	public function get_key(): string {
		return "gs1.product:width:outOfPackageWidth";
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
		return $this->parse($mixed)." cm";
	}
	//--------------------------------------------------------------------------------
}
