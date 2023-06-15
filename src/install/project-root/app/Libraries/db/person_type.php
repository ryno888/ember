<?php

namespace db;

/**
 * @package db
 * @author Ryno Van Zyl
 */
class person_type extends \Kwerqy\Ember\com\db\intf\table {
	//--------------------------------------------------------------------------------
	// properties
	//--------------------------------------------------------------------------------
	public string $name = "person_type";
	public string $key = "pty_id";
	public string $display = "pty_name";

	public string $display_name = "Person Type";

	public array $field_arr = array( // FIELDNAME => DISPLAY[0] DEFAULT[1] TYPE[2] REFERENCE[3]
		"pty_id"			    => array("Id"		            , "null"    , TYPE_KEY, ),
        "pty_name"			    => array("Name"		            , ""        , TYPE_VARCHAR, ),
        "pty_is_individual"	    => array("Is Individual"        , "0"       , TYPE_TINYINT, ),
        "pty_code"			    => array("Code"		            , ""        , TYPE_VARCHAR, ),
        "pty_is_international"	=> array("Is International"		, 0         , TYPE_TINYINT, ),
	);
 	//--------------------------------------------------------------------------------
}