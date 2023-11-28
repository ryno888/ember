<?php
namespace Kwerqy\Ember\com\solid_classes\settings;

/**
 * @package app\property_set\product_property
 * @author Ryno Van Zyl
 * @copyright Copyright Liquid Edge Solutions. All rights reserved.
 */

class company_copyright extends \Kwerqy\Ember\com\solid_classes\settings\intf\standard {

	//--------------------------------------------------------------------------------
	public function get_display_name():string {
		return "Company Copyright";
	}
	//--------------------------------------------------------------------------------
	public function get_code():string {
		return "SETTING_COMPANY_COPYRIGHT";
	}
	//--------------------------------------------------------------------------------
	public function get_key() {
		return "gs1.setting:COMPANY_COPYRIGHT";
	}
	//--------------------------------------------------------------------------------
	public function get_default() {
        return getenv("ember.copyright");
    }
    //--------------------------------------------------------------------------------
    public function on_save(&$obj) {
        $obj->stt_value = htmlentities($obj->stt_value);
    }
    //--------------------------------------------------------------------------------
	public function get_data_type() {
		return TYPE_HTML;
	}
    //--------------------------------------------------------------------------------
	public function parse($mixed, $options = []) {

	    $options = array_merge([
	        "allow_tag_arr" => ["a", "iframe"],
	    ], $options);

        return parent::parse($mixed, $options);
    }
    //--------------------------------------------------------------------------------
    public function get_value($options = []) {
        $options = array_merge([
		    "html_decode" => true
		], $options);

		if(!$options["html_decode"]) return parent::get_value($options);

        return html_entity_decode(parent::get_value($options));
    }
    //--------------------------------------------------------------------------------
}
