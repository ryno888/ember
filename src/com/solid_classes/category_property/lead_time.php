<?php
namespace Kwerqy\Ember\com\solid_classes\category_property;

/**
 * @package app\property_set\solid_classes\person_owner
 * @author Ryno Van Zyl
 * @copyright Copyright Kwerqy. All rights reserved.
 */

class lead_time extends \Kwerqy\Ember\com\solid_classes\intf\dbrow {

	//--------------------------------------------------------------------------------
	public function get_display_name(): string {
		return "Lead Time";
	}
	//--------------------------------------------------------------------------------
	public function get_code(): string {
		return "CATEGORY_PROPERT_LEAD_TIME";
	}
	//--------------------------------------------------------------------------------
	public function get_key(): string {
		return "gs1.category:lead_time";
	}
	//--------------------------------------------------------------------------------
	public function get_data_type() {
		return TYPE_VARCHAR;
	}
	//--------------------------------------------------------------------------------
}
