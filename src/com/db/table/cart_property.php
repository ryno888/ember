<?php

namespace Kwerqy\Ember\com\db\table;

/**
 * @package Kwerqy\Ember\com\db\table
 * @author Ryno Van Zyl
 * @copyright Copyright Kwerqy. All rights reserved.
 */
class cart_property extends \Kwerqy\Ember\com\db\intf\table {

    //--------------------------------------------------------------------------------
	// properties
	//--------------------------------------------------------------------------------
    public string $name = "cart_property";
	 public string $key = "cpo_id";
	public string $display = "cpo_id";

	public string $display_name = "Cart Property";
 	//--------------------------------------------------------------------------------
	// functions
    //--------------------------------------------------------------------------------
    public array $field_arr = array( // FIELDNAME => DISPLAY[0] DEFAULT[1] TYPE[2] REFERENCE[3]
	 	// identification
		"cpo_id"                => array("database id"                  , "null"		, TYPE_INT),
		"cpo_ref_cart"			=> array("cart"							, "null"		, TYPE_REFERENCE, "cart"),
		"cpo_key"               => array("key"                          , ""			, TYPE_VARCHAR),
		"cpo_value"             => array("value"                        , ""			, TYPE_VARCHAR),
    );
	//--------------------------------------------------------------------------------
    // events
    //--------------------------------------------------------------------------------
}