<?php
namespace Kwerqy\Ember\com\solid_classes\product_property;

/**
 * @package app\property_set\product_property
 * @author Ryno Van Zyl
 * @copyright Copyright Kwerqy. All rights reserved.
 */

class is_featured extends \Kwerqy\Ember\com\solid_classes\intf\dbrow {

	//--------------------------------------------------------------------------------
	public function get_display_name(): string {
		return "Is Featured";
	}
	//--------------------------------------------------------------------------------
	public function get_code(): string {
		return "PRODUCT_PROPERTY_IS_FEATURED";
	}
	//--------------------------------------------------------------------------------
	public function get_key(): string {
		return "gs1.product:IS_FEATURED";
	}
	//--------------------------------------------------------------------------------
	public function get_data_type() {
		return TYPE_BOOL;
	}
	//--------------------------------------------------------------------------------
}
