<?php

namespace db;

/**
 * @package db
 * @author Ryno Van Zyl
 */
class email_file_item extends \Kwerqy\Ember\com\db\intf\table {
	//--------------------------------------------------------------------------------
	// properties
	//--------------------------------------------------------------------------------
	public string $name = "email_file_item";
	public string $key = "emf_id";
	public string $display = "emf_id";

	public string $display_name = "Email File Item";

	public array $field_arr = array( // FIELDNAME => DISPLAY[0] DEFAULT[1] TYPE[2] REFERENCE[3]
		"emf_id"				=> array("Id"				, "null"	, TYPE_KEY),
		"emf_ref_email"			=> array("Ref Email"		, "null"	, TYPE_INT, "email"),
		"emf_ref_file_item"		=> array("Ref File Item"	, "null"	, TYPE_INT, "file_item"),
		"emf_cid"				=> array("Cid"				, ""		, TYPE_VARCHAR),
	);
 	//--------------------------------------------------------------------------------
}