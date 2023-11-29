<?php

namespace Kwerqy\Ember\com\db\table;

/**
 * @package Kwerqy\Ember\com\db\table
 * @author Ryno Van Zyl
 * @copyright Copyright Kwerqy. All rights reserved.
 */
class cart_item_property extends \Kwerqy\Ember\com\db\intf\table {

    //--------------------------------------------------------------------------------
	// properties
	//--------------------------------------------------------------------------------
    public string $name = "cart_item_property";
	 public string $key = "cip_id";
	public string $display = "cip_id";

	public string $display_name = "Cart Property";
 	//--------------------------------------------------------------------------------
	// functions
    //--------------------------------------------------------------------------------
    public array $field_arr = array( // FIELDNAME => DISPLAY[0] DEFAULT[1] TYPE[2] REFERENCE[3]
	 	// identification
		"cip_id"                => array("database id"                  , "null"		, TYPE_INT),
		"cip_ref_cart_item"		=> array("cart item"					, "null"		, TYPE_REFERENCE, "cart_item"),
		"cip_key"               => array("key"                          , ""			, TYPE_VARCHAR),
		"cip_value"             => array("value"                        , ""			, TYPE_TEXT),
    );
    //--------------------------------------------------------------------------------
    // events
    //--------------------------------------------------------------------------------
}