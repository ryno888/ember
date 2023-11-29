<?php

namespace Kwerqy\Ember\com\db\table;

/**
 * @package Kwerqy\Ember\com\db\table
 * @author Ryno Van Zyl
 * @copyright Copyright Kwerqy. All rights reserved.
 */
class courier extends \Kwerqy\Ember\com\db\intf\table {

	//--------------------------------------------------------------------------------
	// properties
	//--------------------------------------------------------------------------------
	public string $name = "courier";
	public string $key = "cou_id";
	public string $display = "cou_api_account_id";
	
    public string $display_name = "courier";
	
    public array $field_arr = array(// FIELDNAME => DISPLAY[0] DEFAULT[1] TYPE[2] REFERENCE[3]
		// identification
		"cou_id"				=> array("id"				, "null"	, TYPE_INT),
		"cou_api_account_id"	=> array("api account name"	, ""		, TYPE_VARCHAR),
		"cou_api_key"			=> array("api key"			, ""		, TYPE_VARCHAR),
		"cou_api_password"		=> array("api password"		, ""		, TYPE_VARCHAR),
		"cou_api_url"			=> array("api url"			, ""		, TYPE_VARCHAR),
		"cou_type"				=> array("type"				, 0			, TYPE_ENUM),
		"cou_is_active"			=> array("is active"		, 0			, TYPE_ENUM),

		"cou_ref_person"		=> array("person"   		, "null"  	, TYPE_REFERENCE, "person"),
		"cou_flat_fee"			=> array("flat fee"			, 0.00000 	, TYPE_DECIMAL),
	);
	
	//--------------------------------------------------------------------------------
	// enums
	//--------------------------------------------------------------------------------
	public $cou_type = [
		0 => "-- Not Selected --",
		1 => "Ram",
		2 => "Courier Guy",
		3 => "Parcel Perfect",
		4 => "Ship Logic",
	];
	//--------------------------------------------------------------------------------
	public $cou_is_active = [
		0 => "No",
		1 => "Yes",
	];

	//--------------------------------------------------------------------------------
	// events
	//--------------------------------------------------------------------------------
}