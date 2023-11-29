<?php
namespace Kwerqy\Ember\com\solid_classes\category_property;

/**
 * @package app\property_set\solid_classes\person_owner
 * @author Ryno Van Zyl
 * @copyright Copyright Kwerqy. All rights reserved.
 */

class seo_code extends \Kwerqy\Ember\com\solid_classes\intf\dbrow {

	//--------------------------------------------------------------------------------
	public function get_display_name(): string {
		return "SEO Code";
	}
	//--------------------------------------------------------------------------------
	public function get_code(): string {
		return "CATEGORY_PROPERT_SEO_CODE";
	}
	//--------------------------------------------------------------------------------
	public function get_key(): string {
		return "gs1.category:seo_code";
	}
	//--------------------------------------------------------------------------------
	public function get_data_type() {
		return TYPE_VARCHAR;
	}
	//--------------------------------------------------------------------------------
}
