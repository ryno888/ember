<?php

namespace Kwerqy\Ember\com\db\table;

/**
 * @package Kwerqy\Ember\com\db\table
 * @author Ryno Van Zyl
 * @copyright Copyright Kwerqy. All rights reserved.
 */

class coupon_code extends \Kwerqy\Ember\com\db\intf\table {

    //--------------------------------------------------------------------------------
    // properties
    //--------------------------------------------------------------------------------
    public string $name = "coupon_code";
    public string $key = "cop_id";
    public string $display = "cop_date_start";
    
    public string $display_name = "Coupon Code";
    public $slug = "cop_code";

    
    public array $field_arr = array(// FIELDNAME => DISPLAY[0] DEFAULT[1] TYPE[2] REFERENCE[3]
        // identification
        "cop_id"                => array("id"               , "null"        , TYPE_INT),
        "cop_title"             => array("title"            , ""            , TYPE_VARCHAR),
        "cop_code"              => array("code"             , ""            , TYPE_VARCHAR),
        "cop_value"             => array("value"            , 0             , TYPE_DECIMAL),
        "cop_percentage"        => array("percentage"       , 0             , TYPE_DECIMAL),
        "cop_date_start"        => array("start date"       , "null"        , TYPE_DATE),
        "cop_date_end"          => array("end date"         , "null"        , TYPE_DATE),
        "cop_ref_person"		=> array("coupon user"	    , "null"        , TYPE_REFERENCE, "person"),
        "cop_ref_promotion"		=> array("coupon promotion"	, "null"        , TYPE_REFERENCE, "promotion"),
        "cop_status"		    => array("coupon status"	, 0	            , TYPE_ENUM),
    );
    //--------------------------------------------------------------------------------
    public $cop_status = [
        0 => "-- Not Selected --",
        1 => "Active",
        2 => "Redeemed",
        3 => "Inactive",
    ];
    //--------------------------------------------------------------------------------
    public $cop_type = [
        0 => "-- Not Selected --",
        1 => "Birthday",
        2 => "Other",
    ];
    //--------------------------------------------------------------------------------
    // events
	//--------------------------------------------------------------------------------
    public function build_slug(): string {

        $slug_parts = [];
        $slug_parts[] = $this->get_prefix();
        $slug_parts[] = $this->get_last_inserted_id();
        $slug_parts[] = time();

        return implode("-", $slug_parts);

    }
    //--------------------------------------------------------------------------------

}