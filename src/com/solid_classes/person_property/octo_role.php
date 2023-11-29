<?php
namespace Kwerqy\Ember\com\solid_classes\person_property;

/**
 * @package app\property_set\solid_classes\person
 * @author Ryno Van Zyl
 * @copyright Copyright Kwerqy. All rights reserved.
 */

class octo_role extends \Kwerqy\Ember\com\solid_classes\intf\dbrow {

	//--------------------------------------------------------------------------------
	public function get_display_name() : string {
		return "Octo Role";
	}
	//--------------------------------------------------------------------------------
	public function get_code() : string {
		return "PERSON_PROPERTY_OCTO_ROLE";
	}
	//--------------------------------------------------------------------------------
	public function get_key() : string {
		return "gs1.person.property:OCTO_ROLE";
	}
	//--------------------------------------------------------------------------------
	public function get_data_type() {
		TYPE_STRING;
	}
	//--------------------------------------------------------------------------------

	/**
	 * @param $mixed
	 * @param array $options
	 * @return mixed|string
	 */
	public function format($mixed, $options = []){

	    if(!$mixed) return $this->get_display_name();

	    $mixed_parts = explode(":", $mixed);

	    $label = end($mixed_parts);

	    return \app\str::propercase($label);
	}
	//--------------------------------------------------------------------------------
}
