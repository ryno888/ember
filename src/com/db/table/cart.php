<?php

namespace Kwerqy\Ember\com\db\table;

/**
 * @author Ryno Van Zyl
 * @copyright Copyright Kwerqy. All rights reserved.
 */
class cart extends \Kwerqy\Ember\com\db\intf\table {

    use \Kwerqy\Ember\com\db\tra\property_table;

	//--------------------------------------------------------------------------------
	// properties
	//--------------------------------------------------------------------------------
    public string $name = "cart";
   	public string $key = "crt_id";
    public string $display = "crt_order_number";
    public string $string = "crt_order_number";

    public string $display_name = "cart";
    public string $slug = "crt_order_number";
    
    public string $property_table = "cart_property";

    public array $field_arr = array(// FIELDNAME => DISPLAY[0] DEFAULT[1] TYPE[2] REFERENCE[3]
        // identification
        "crt_id"                    => array("id",                  	"null"		,TYPE_KEY),
        "crt_payment_type"          => array("payment type",        	0			,TYPE_ENUM),
        "crt_ship_to"               => array("ship to",             	0			,TYPE_ENUM),
        "crt_ref_person_billing"    => array("billing person",      	"null"		,TYPE_REFERENCE, "person"),
        "crt_ref_person_agent"      => array("agent person",        	"null"		,TYPE_REFERENCE, "person"),
        "crt_ref_person_shipping"   => array("shipping person",     	"null"		,TYPE_REFERENCE, "person"),
        "crt_ref_person_created"    => array("person created",      	"null"		,TYPE_REFERENCE, "person"),
		"crt_ref_person_modified"	=> array("person modified",			"null"		,TYPE_REFERENCE, "person"),
        "crt_ref_payment_option"    => array("payment option",      	"null"		,TYPE_REFERENCE, "payment_option"),
        "crt_ref_courier"			=> array("courier",					"null"		,TYPE_REFERENCE, "courier"),
        "crt_ref_person_owner"		=> array("shop owner",				"null"		,TYPE_REFERENCE, "person"),
        "crt_surcharge_percentage"	=> array("surcharge percentage", 	0.00000		,TYPE_DECIMAL),
        "crt_surcharge"    			=> array("surcharge",     			0.00000		,TYPE_DECIMAL),
        "crt_grand_total_incl"    	=> array("grand total incl",     	0.00000		,TYPE_DECIMAL),
        "crt_total_incl"            => array("total incl",      		0.00000		,TYPE_DECIMAL),
        "crt_total_excl"            => array("total excl",      		0.00000		,TYPE_DECIMAL),
        "crt_total_items"           => array("total items",         	0			,TYPE_INT),
        "crt_remote_id"           	=> array("remote id",         		0			,TYPE_INT),
        "crt_cart_data"             => array("cart data",           	""			,TYPE_TEXT),
        "crt_latest_update_reason"	=> array("update reason",			""			,TYPE_TEXT),
        "crt_date_created"          => array("date created",        	"null"		,TYPE_DATETIME),
        "crt_date_modified"			=> array("date modified",			"null"		,TYPE_DATETIME),
        "crt_order_number"          => array("order number",        	""			,TYPE_VARCHAR),
        "crt_waybill_number"		=> array("waybill number",			""			,TYPE_VARCHAR),
        "crt_status"                => array("status",              	0			,TYPE_ENUM),
        "crt_ref_address"           => array("address",             	"null"		,TYPE_REFERENCE, "address"),
        "crt_ref_address_billing"	=> array("billing address",			"null"		,TYPE_REFERENCE, "address"),
        "crt_ref_coupon_code"	    => array("coupon code",		    	"null"		,TYPE_REFERENCE, "coupon_code"),
        "crt_ref_email_billing"	    => array("email billing",	    	"null"		,TYPE_REFERENCE, "email"),
        "crt_ref_email_admin"	    => array("email admin",		    	"null"		,TYPE_REFERENCE, "email"),

		"crt_special_instruction"	=> array("special instructions"		, ""		,TYPE_TEXT),
        "crt_shipping_total_excl"	=> array("shipping total excl",     0.00000		,TYPE_DECIMAL),
        "crt_shipping_total_incl"	=> array("shipping total incl",     0.00000		,TYPE_DECIMAL),
        "crt_is_secure"				=> array("cart is secured",			0			,TYPE_BOOL),
        "crt_is_seen"				=> array("cart is seen",			0			,TYPE_BOOL),
        "crt_is_deleted"			=> array("cart is_deleted",			0			,TYPE_BOOL),

		"crt_width"					=> array("height",					0.00000		, TYPE_DECIMAL),
		"crt_length"				=> array("length",					0.00000		, TYPE_DECIMAL),
		"crt_breadth"				=> array("breadth",					0.00000		, TYPE_DECIMAL),
		"crt_weight"				=> array("breadth",					0.00000		, TYPE_DECIMAL),
        "crt_is_vat_registered"		=> array("vat registered",			0			, TYPE_BOOL),
		
        "crt_custom_1"				=> array("custom 1",				""			,TYPE_VARCHAR),
        "crt_custom_2"				=> array("custom 2",				""			,TYPE_VARCHAR),
        "crt_custom_3"				=> array("custom 3",				""			,TYPE_VARCHAR),
        "crt_custom_4"				=> array("custom 4",				""			,TYPE_VARCHAR),
        "crt_payment_reference"	    => array("payment reference",   	""			,TYPE_VARCHAR),
        "crt_findstring"			=> array("findstring",				""			,TYPE_TEXT),
    );


    //--------------------------------------------------------------------------------
    // enums
    //--------------------------------------------------------------------------------
    public $crt_payment_type = [
        0 => "-- Not Selected --",
        1 => "Cash on Collection",
        2 => "Account",
        3 => "Debit/Credit",
    ];
    //--------------------------------------------------------------------------------
    public $crt_ship_to = [
        0 => "-- Not Selected --",
    ];
    //--------------------------------------------------------------------------------
    public $crt_status = [
        0 => "-- Not Selected --",
    ];
    //--------------------------------------------------------------------------------
    public $crt_process_status = [
        0 => "-- Not Selected --",
        1 => "Waiting to be processed",
        2 => "Ready for collection",
        3 => "Collected by Courier",
        4 => "Cancelled",
        5 => "Complete",
    ];
    //--------------------------------------------------------------------------------
    // events
	//--------------------------------------------------------------------------------
    public function on_save(&$obj) {
		parent::on_save($obj);
		if(!$obj->is_empty("crt_findstring")) $obj->build_findstring();
	}
	//--------------------------------------------------------------------------------
    public function on_insert(&$obj) {
        parent::on_insert($obj);
        $obj->crt_date_created = \Kwerqy\Ember\com\date\date::strtodatetime();

        if($obj->is_empty("crt_order_number")){
			$obj->crt_order_number = self::generate_order_number();
			if($obj->is_empty("crt_payment_reference")) $obj->crt_payment_reference = $obj->crt_order_number;
		}

    }
    //--------------------------------------------------------------------------------
    public function on_update(&$obj, &$current_obj) {
		parent::on_update($obj, $current_obj);

		if($obj->is_empty("crt_order_number")) $obj->crt_order_number = self::generate_order_number();
		if(!$obj->is_empty("crt_findstring")) $obj->build_findstring();
	}
    //--------------------------------------------------------------------------------
    public function get_cart_item_arr($cart, $options = []) {
		$sql = \Kwerqy\Ember\com\db\sql\select::make();
		$sql->select("cart_item.*");
		$sql->from("cart_item");
		$sql->and_where("cti_ref_cart = $cart->id");
		$sql->extract_options($options);
        return \core::dbt("cart_item")->get_fromsql($sql->build(), ["multiple" => true]);
    }
    //--------------------------------------------------------------------------------
    public static function generate_order_number() {

		$return[] = settings::get_value(SETTING_ORDER_PREFIX, ["default" => "ORDER"]);
		$return[] = \core::dbt("cart")->get_next_id();
        $return[] = time();
		return implode("-", $return);

    }
	//--------------------------------------------------------------------------------
    public function build_findstring($cart) {
        $findstring_arr = [];
        
		$findstring_arr[] = $cart->crt_order_number;
		if($cart->person_billing) $findstring_arr[] = "{$cart->person_billing->per_name},{$cart->person_billing->format_name()}";
		if($cart->person_agent) $findstring_arr[] = "{$cart->person_agent->per_name},{$cart->person_agent->format_name()}";
		if(!$cart->is_empty("crt_waybill_number")) $findstring_arr[] = $cart->crt_waybill_number;
		
		
        $str = implode(",", $findstring_arr);
        return $cart->crt_findstring = str_replace(" ", "", strlen($str) > 240 ? substr($str, 0, 240) : $str);
    }
    //--------------------------------------------------------------------------------

}
