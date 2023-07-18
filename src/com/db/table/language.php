<?php

namespace Kwerqy\Ember\com\db\table;

/**
 * @package db
 * @author Ryno Van Zyl
 */
class language extends \Kwerqy\Ember\com\db\intf\table {
	//--------------------------------------------------------------------------------
	// properties
	//--------------------------------------------------------------------------------
	public string $name = "language";
	public string $key = "lan_id";
	public string $display = "lan_name";

	public string $display_name = "Language";

	public array $field_arr = array( // FIELDNAME => DISPLAY[0] DEFAULT[1] TYPE[2] REFERENCE[3]
		"lan_id"			=> array("Id"		, "null"    , TYPE_KEY, ),
        "lan_name"			=> array("Name"		, ""        , TYPE_VARCHAR, ),
	);
 	//--------------------------------------------------------------------------------
}