<?php
namespace Kwerqy\Ember\com\solid_classes\product_property;

/**
 * @package app\property_set\product_property
 * @author Ryno Van Zyl
 * @copyright Copyright Kwerqy. All rights reserved.
 */

class is_parent extends \Kwerqy\Ember\com\solid_classes\intf\dbrow {

	//--------------------------------------------------------------------------------
	public function get_display_name(): string {
		return "Is Parent";
	}
	//--------------------------------------------------------------------------------
	public function get_code(): string {
		return "PRODUCT_PROPERTY_IS_PARENT";
	}
	//--------------------------------------------------------------------------------
	public function get_key(): string {
		return "gs1.product:IS_PARENT";
	}
	//--------------------------------------------------------------------------------
	public function get_data_type() {
		return TYPE_BOOL;
	}
	//--------------------------------------------------------------------------------
}
