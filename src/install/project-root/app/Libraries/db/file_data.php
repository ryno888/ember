<?php

namespace db;

/**
 * @package db
 * @author Ryno Van Zyl
 */
class file_data extends \Kwerqy\Ember\com\db\intf\table {
	//--------------------------------------------------------------------------------
	// properties
	//--------------------------------------------------------------------------------
	public string $name = "file_data";
	public string $key = "fid_id";
	public string $display = "fid_id";

	public string $display_name = "File Data";

	public array $field_arr = array( // FIELDNAME => DISPLAY[0] DEFAULT[1] TYPE[2] REFERENCE[3]
		"fid_id"			=> array("Id"		, "null", TYPE_KEY),
		"fid_data"			=> array("Data"		, "null", TYPE_LONGBLOB),
	);
 	//--------------------------------------------------------------------------------
}