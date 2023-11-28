<?php
namespace Kwerqy\Ember\com\solid_classes\product_property;

/**
 * @package app\property_set\product_property
 * @author Ryno Van Zyl
 * @copyright Copyright Liquid Edge Solutions. All rights reserved.
 */

class stock_on_hand extends \Kwerqy\Ember\com\solid_classes\intf\dbrow {

	//--------------------------------------------------------------------------------
	public function get_display_name(): string {
		return "Stock on hand";
	}
	//--------------------------------------------------------------------------------
	public function get_code(): string {
		return "PRODUCT_PROPERTY_STOCK_ON_HAND";
	}
	//--------------------------------------------------------------------------------
	public function get_key(): string {
		return "urn:gs1:gdd:cl:TransactionalReferenceTypeCode:GRNonHand";
	}
	//--------------------------------------------------------------------------------
	public function get_data_type() {
		return \com\data::TYPE_INT;
	}
	//--------------------------------------------------------------------------------
}
