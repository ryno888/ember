<?php

namespace Kwerqy\Ember\com\db\table;

/**
 * @package Kwerqy\Ember\com\db\table
 * @author Ryno Van Zyl
 * @copyright Copyright Kwerqy. All rights reserved.
 */
class payment_option extends \Kwerqy\Ember\com\db\intf\table {

    //--------------------------------------------------------------------------------
    // properties
    //--------------------------------------------------------------------------------
    public string $name = "payment_option";
    public string $key = "pao_id";
    public string $display = "pao_name";
    
    public string $display_name = "Payment Option";
    
    public array $field_arr = array(// FIELDNAME => DISPLAY[0] DEFAULT[1] TYPE[2] REFERENCE[3]
        // identification
        "pao_id"            => array("id"           , "null"    , TYPE_INT),
        "pao_name"          => array("title"       	, ""        , TYPE_VARCHAR),
        "pao_type"          => array("type"         , 0         , TYPE_ENUM),
        "pao_type_code"     => array("code"         , ""        , TYPE_VARCHAR),
        "pao_api_url"      	=> array("API URL" 		, ""        , TYPE_VARCHAR),
        "pao_config_1"      => array("API ID" 		, ""        , TYPE_VARCHAR),
        "pao_config_2"      => array("API Key"		, ""        , TYPE_VARCHAR),
        "pao_config_3"      => array("API Secret"  	, ""        , TYPE_VARCHAR),
        "pao_is_enabled"	=> array("is enabled"   , 0         , TYPE_BOOL),
        "pao_is_default"	=> array("is default"   , 0         , TYPE_BOOL),
		"pao_ref_person"	=> array("person"   	, "null"  	, TYPE_REFERENCE, "person"),
    );
    
    //--------------------------------------------------------------------------------
    // enums
    //--------------------------------------------------------------------------------
    public $pao_type = [
        PAO_TYPE_CUSTOM => "Custom / COD",
        PAO_TYPE_NETCASH => "Netcash",
        PAO_TYPE_PAYFAST => "PayFast",
        PAO_TYPE_YOCO => "Yoco",
    ];
    //--------------------------------------------------------------------------------
    // events
    //--------------------------------------------------------------------------------
}