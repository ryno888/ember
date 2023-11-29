<?php
namespace Kwerqy\Ember\com\solid_classes\product_property;

/**
 * @package app\property_set\product_property
 * @author Ryno Van Zyl
 * @copyright Copyright Kwerqy. All rights reserved.
 */

class unit_of_measure extends \Kwerqy\Ember\com\solid_classes\intf\dbrow {

	//--------------------------------------------------------------------------------
	public function get_display_name(): string {
		return "Unit of measure";
	}
	//--------------------------------------------------------------------------------
	public function get_code(): string {
		return "PRODUCT_PROPERTY_UNIT_OF_MEASURE";
	}
	//--------------------------------------------------------------------------------
	public function get_key(): string {
		return "urn:gs1:gdd:cl:FunctionalBasisUnitCode";
	}
	//--------------------------------------------------------------------------------
	public function get_data_type() {
		return TYPE_VARCHAR;
	}
	//--------------------------------------------------------------------------------
}
