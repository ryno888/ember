<?php

namespace db;

/**
 * @package db
 * @author Ryno Van Zyl
 */
class country extends \Kwerqy\Ember\com\db\intf\table {
	//--------------------------------------------------------------------------------
	// properties
	//--------------------------------------------------------------------------------
	public string $name = "country";
	public string $key = "con_id";
	public string $display = "con_id";

	public string $display_name = "Country";
	public string $slug = "con_slug";

	public array $field_arr = array( // FIELDNAME => DISPLAY[0] DEFAULT[1] TYPE[2] REFERENCE[3]
		"con_id"			=> array("Id"		, "null"	, TYPE_KEY),
		"con_name"			=> array("Name"		, ""		, TYPE_VARCHAR),
		"con_code"			=> array("Code"		, ""		, TYPE_VARCHAR),
		"con_slug"			=> array("slug"		, ""		, TYPE_VARCHAR),
	);
 	//--------------------------------------------------------------------------------
}