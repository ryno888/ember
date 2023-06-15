<?php

namespace db;

/**
 * @package db
 * @author Ryno Van Zyl
 */
class email_extension extends \Kwerqy\Ember\com\db\intf\table {
	//--------------------------------------------------------------------------------
	// properties
	//--------------------------------------------------------------------------------
	public string $name = "email_extension";
	public string $key = "eme_id";
	public string $display = "eme_id";

	public string $display_name = "Email Extension";

	public array $field_arr = array( // FIELDNAME => DISPLAY[0] DEFAULT[1] TYPE[2] REFERENCE[3]
		"eme_id"			=> array("Id"			, "null"	, TYPE_KEY),
		"eme_type"			=> array("Type"			, "0"		, TYPE_TINYINT),
		"eme_value"			=> array("Value"		, ""		, TYPE_VARCHAR),
		"eme_ref_email"		=> array("Ref Email"	, "null"	, TYPE_INT, "email"),
	);
 	//--------------------------------------------------------------------------------
}