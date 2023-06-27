<?php

namespace db;

/**
 * @package db
 * @author Ryno Van Zyl
 */
class acl_role extends \Kwerqy\Ember\com\db\intf\table {
	//--------------------------------------------------------------------------------
	// properties
	//--------------------------------------------------------------------------------
	public string $name = "acl_role";
	public string $key = "acl_id";
	public string $display = "acl_name";

	public string $display_name = "Acl Role";
	public string $slug = "acl_slug";

	public array $field_arr = array( // FIELDNAME => DISPLAY[0] DEFAULT[1] TYPE[2] REFERENCE[3]
		"acl_id"			=> array("Id"				, "null"	, TYPE_KEY),
		"acl_name"			=> array("Name"				, ""		, TYPE_VARCHAR),
		"acl_code"			=> array("Code"				, ""		, TYPE_VARCHAR),
		"acl_is_locked"		=> array("Is Locked"		, 0		    , TYPE_TINYINT),
		"acl_level"			=> array("Level"			, 0.00000	, TYPE_DECIMAL),
		"acl_slug"			=> array("slug"				, ""		, TYPE_VARCHAR),
	);
 	//--------------------------------------------------------------------------------
}