<?php

namespace Kwerqy\Ember\com\db\table;

/**
 * @author Ryno Van Zyl
 * @copyright Copyright Liquid Edge Solutions. All rights reserved.
 */

class product_property extends \Kwerqy\Ember\com\db\intf\table {

	//--------------------------------------------------------------------------------
	// properties
	//--------------------------------------------------------------------------------
	public string $name = "product_property";
	public string $key = "pdp_id";
	public string $display = "pdp_key";
	
    public string $display_name = "product_property";
    public string $string = "pdp_key";

    public array $field_arr = array(// FIELDNAME => DISPLAY[0] DEFAULT[1] TYPE[2] REFERENCE[3]
		// identification
		"pdp_id"					=> array("id"				, "null"	, TYPE_KEY),
		"pdp_key"					=> array("key"				, ""		, TYPE_VARCHAR),
		"pdp_value"					=> array("value"			, ""		, TYPE_TEXT),
		"pdp_ref_product"		    => array("product"			, "null"	, TYPE_REFERENCE, "product"),
		"pdp_ref_product_property"	=> array("product property"	, "null"	, TYPE_REFERENCE, "product_property"),
	);
	//--------------------------------------------------------------------------------
}