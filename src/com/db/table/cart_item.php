<?php

namespace Kwerqy\Ember\com\db\table;

/**
 * @package Kwerqy\Ember\com\db\table
 * @author Ryno Van Zyl
 * @copyright Copyright Kwerqy. All rights reserved.
 */
class cart_item extends \Kwerqy\Ember\com\db\intf\table {

    use \Kwerqy\Ember\com\db\tra\property_table;

    //--------------------------------------------------------------------------------
    // properties
    //--------------------------------------------------------------------------------
    public string $name = "cart_item";
     public string $key = "cti_id";
    public string $display = "cti_ref_cart";

    public string $display_name = "cart_item";
    
    public string $property_table = "cart_item_property";

    public array $field_arr = array(// FIELDNAME => DISPLAY[0] DEFAULT[1] TYPE[2] REFERENCE[3]
        // identification
        "cti_id"                => array("id"					, "null"		, TYPE_INT),
        "cti_ref_cart"          => array("cart"					, "null"		, TYPE_REFERENCE, "cart"),
        "cti_ref_product"       => array("product"				, "null"		, TYPE_REFERENCE, "product"),
        "cti_ref_person_from"	=> array("from"					, "null"		, TYPE_REFERENCE, "person"),
        "cti_qty"               => array("qty"					, 0				, TYPE_INT),
        "cti_unit_price"        => array("unit price"			, 0.00000		, TYPE_DECIMAL),
        "cti_qty_backlog"		=> array("qty in backlog"		, 0				, TYPE_INT),
        "cti_lead_time"			=> array("lead time in days"	, 0				, TYPE_INT),
    );

    //--------------------------------------------------------------------------------
    // events
    //--------------------------------------------------------------------------------
}
