<?php
namespace Kwerqy\Ember\com\solid_classes\product_property;

/**
 * @package app\property_set\product_property
 * @author Ryno Van Zyl
 * @copyright Copyright Kwerqy. All rights reserved.
 */

class pro_description extends \Kwerqy\Ember\com\solid_classes\intf\dbrow {

	//--------------------------------------------------------------------------------
	public function get_display_name(): string {
		return "Description";
	}
	//--------------------------------------------------------------------------------
	public function get_code(): string {
		return "PRODUCT_PROPERTY_PRO_DESCRIPTION";
	}
	//--------------------------------------------------------------------------------
	public function get_key(): string {
		return "gs1.product:productDescription";
	}
	//--------------------------------------------------------------------------------
	public function get_data_type() {
		return \com\data::TYPE_TEXT;
	}
	//--------------------------------------------------------------------------------
}
