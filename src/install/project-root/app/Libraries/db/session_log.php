<?php

namespace db;

/**
 * @package db
 * @author Ryno Van Zyl
 */
class session_log extends \Kwerqy\Ember\com\db\intf\table {
	//--------------------------------------------------------------------------------
	// properties
	//--------------------------------------------------------------------------------
	public string $name = "session_log";
	public string $key = "sel_id";
	public string $display = "sel_id";

	public string $display_name = "Session Log";

	public array $field_arr = array( // FIELDNAME => DISPLAY[0] DEFAULT[1] TYPE[2] REFERENCE[3]
		"sel_id"			=> array("Id"		    , "null"        , TYPE_KEY, ),
        "sel_url"			=> array("Url"		    , ""            , TYPE_VARCHAR, ),
        "sel_ref_session"   => array("Ref Session"  , "null"        , TYPE_INT, "session"),
        "sel_date"			=> array("Date"		    , "null"        , TYPE_DATETIME, ),
        "sel_controller"    => array("Controller"   , ""            , TYPE_VARCHAR, ),
        "sel_view"			=> array("View"		    , ""            , TYPE_VARCHAR, ),
        "sel_context"	    => array("Context"		, ""            , TYPE_VARCHAR, ),
        "sel_db_count"	    => array("Db Count"		, 0             , TYPE_INT, ),
        "sel_error_count"   => array("Error Count"  , 0             , TYPE_INT, ),
        "sel_db_time"	    => array("Db Time"		, 0.0000        , TYPE_DECIMAL, ),
        "sel_external_time" => array("External Time", 0.0000        , TYPE_DECIMAL, ),
        "sel_php_time"	    => array("Php Time"		, 0.0000        , TYPE_DECIMAL, ),
        "sel_total_time"    => array("Total Time"	, 0.0000        , TYPE_DECIMAL, ),
        "sel_peak_memory"   => array("Peak Memory"	, 0             , TYPE_INT, ),
        "sel_page_size"	    => array("Page Size"	, 0             , TYPE_INT, ),
        "sel_is_ajax"	    => array("Is Ajax"		, 0             , TYPE_TINYINT, ),
	);
 	//--------------------------------------------------------------------------------
}