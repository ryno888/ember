<?php

namespace Kwerqy\Ember\com\db\table;

/**
 * @package db
 * @author Ryno Van Zyl
 */
class province extends \Kwerqy\Ember\com\db\intf\table {
	//--------------------------------------------------------------------------------
	// properties
	//--------------------------------------------------------------------------------
	public string $name = "province";
	public string $key = "prv_id";
	public string $display = "prv_name";

	public string $display_name = "Province";
	public string $slug = "prv_slug";

	public array $field_arr = array( // FIELDNAME => DISPLAY[0] DEFAULT[1] TYPE[2] REFERENCE[3]
		"prv_id"			=> array("Id"		    , "null"    , TYPE_KEY, ),
        "prv_name"			=> array("Name"		    , ""        , TYPE_VARCHAR, ),
        "prv_ref_country"   => array("Ref Country"  , "null"    , TYPE_INT, "country"),
        "prv_slug"			=> array("slug"		    , ""        , TYPE_VARCHAR, ),
	);
 	//--------------------------------------------------------------------------------
}