<?php

namespace Kwerqy\Ember\com\db\table;

/**
 * @author Ryno Van Zyl
 * @copyright Copyright Kwerqy. All rights reserved.
 */
class category_property extends \Kwerqy\Ember\com\db\intf\table {

	//--------------------------------------------------------------------------------
	// properties
	//--------------------------------------------------------------------------------
	public string $name = "category_property";
	public string $key = "cap_id";
	public string $display = "cap_name";
	
    public string $display_name = "category property";
	
    public array $field_arr = array(// FIELDNAME => DISPLAY[0] DEFAULT[1] TYPE[2] REFERENCE[3]
		// identification
		"cap_id"					=> array("id"				, "null"	, TYPE_KEY),
		"cap_key"					=> array("key"				, ""		, TYPE_VARCHAR),
		"cap_value"					=> array("value"			, ""		, TYPE_TEXT),
		"cap_ref_category"			=> array("category"			, "null"	, TYPE_REFERENCE, "category"),
		"cap_date_created"			=> array("date created"		, "null"	, TYPE_DATETIME),
	);
	//--------------------------------------------------------------------------------
	// events
	//--------------------------------------------------------------------------------
}