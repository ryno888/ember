<?php

namespace Kwerqy\Ember\com\db\table;

/**
 * @package db
 * @author Ryno Van Zyl
 */
class town extends \Kwerqy\Ember\com\db\intf\table {
	//--------------------------------------------------------------------------------
	// properties
	//--------------------------------------------------------------------------------
	public string $name = "town";
	public string $key = "tow_id";
	public string $display = "tow_name";

	public string $display_name = "Town";
	public string $slug = "tow_slug";

	public array $field_arr = array( // FIELDNAME => DISPLAY[0] DEFAULT[1] TYPE[2] REFERENCE[3]
		"tow_id"			=> array("Id"		    , "null"    , TYPE_KEY, ),
        "tow_name"			=> array("Name"		    , ""        , TYPE_VARCHAR, ),
        "tow_name_af"	    => array("Name Af"		, ""        , TYPE_VARCHAR, ),
        "tow_ref_province"	=> array("Ref Province"	, "null"    , TYPE_INT, "province"),
        "tow_ref_country"	=> array("Ref Country"	, "null"    , TYPE_INT, "country"),
        "tow_slug"	        => array("slug"		    , ""        , TYPE_VARCHAR, ),
	);
 	//--------------------------------------------------------------------------------
}