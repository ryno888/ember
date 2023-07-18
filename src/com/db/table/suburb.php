<?php

namespace Kwerqy\Ember\com\db\table;

/**
 * @package db
 * @author Ryno Van Zyl
 */
class suburb extends \Kwerqy\Ember\com\db\intf\table {
	//--------------------------------------------------------------------------------
	// properties
	//--------------------------------------------------------------------------------
	public string $name = "suburb";
	public string $key = "sub_id";
	public string $display = "sub_name";

	public string $display_name = "Suburb";
	public string $slug = "sub_slug";

	public array $field_arr = array( // FIELDNAME => DISPLAY[0] DEFAULT[1] TYPE[2] REFERENCE[3]
		"sub_id"			    => array("Id"		        , "null"    , TYPE_KEY, ),
        "sub_name"			    => array("Name"		        , ""        , TYPE_VARCHAR, ),
        "sub_name_af"			=> array("Name Af"		    , ""        , TYPE_VARCHAR, ),
        "sub_ref_town"			=> array("Ref Town"		    , "null"    , TYPE_INT, "town"),
        "sub_postal_code"	    => array("Postal Code"		, ""        , TYPE_VARCHAR, ),
        "sub_residential_code"  => array("Residential Code" , ""        , TYPE_VARCHAR, ),
        "sub_slug"              => array("slug"             , ""        , TYPE_VARCHAR, ),
	);
 	//--------------------------------------------------------------------------------
}