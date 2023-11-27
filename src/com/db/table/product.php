<?php

namespace Kwerqy\Ember\com\db\table;

/**
 * @package db
 * @author Ryno Van Zyl
 */
class product extends \Kwerqy\Ember\com\db\intf\table {

	use \Kwerqy\Ember\com\db\tra\property_table;

	//--------------------------------------------------------------------------------
	// properties
	//--------------------------------------------------------------------------------
	public string $name = "product";
	public string $key = "pro_id";
	public string $display = "pro_name";

	public string $display_name = "product";
	public string $slug = "pro_slug";
	public string $property_table = "product_property";

	public array $field_arr = array( // FIELDNAME => DISPLAY[0] DEFAULT[1] TYPE[2] REFERENCE[3]
		// identification
        "pro_id"                            => array("database id"                  , "null"    , TYPE_INT),
		"pro_name"                          => array("name"                         , ""		, TYPE_VARCHAR),
		"pro_type" 					        => array("type"					        , 0			, TYPE_ENUM),
		"pro_description" 					=> array("description"					, ""		, TYPE_TEXT),
		"pro_key"                           => array("Product Code"                 , ""		, TYPE_VARCHAR),
        "pro_is_deleted"                    => array("is deleted"                   , 0         , TYPE_BOOL),
        "pro_is_new"                        => array("is new"                       , 0         , TYPE_BOOL),
        "pro_is_published"                  => array("is published"                 , 0         , TYPE_BOOL),
        "pro_is_featured"                   => array("is featured"                  , 0         , TYPE_BOOL),
        "pro_date_created"                  => array("date created"                 , "null"    , TYPE_DATE),
        "pro_findstring"                    => array("findstring"                   , ""        , TYPE_TEXT),
        "pro_slug"                          => array("seo_name"                     , ""        , TYPE_VARCHAR),
        "pro_source"                      	=> array("source"                     	, 0			, TYPE_ENUM),
        "pro_price"                      	=> array("price"                     	, 0			, TYPE_DECIMAL),
        "pro_stock"                         => array("stock"                        , 0         , TYPE_INT),
	);
 	//--------------------------------------------------------------------------------
    public $pro_type = [
        null => "-- Not Selected --",  
    ];
 	//--------------------------------------------------------------------------------
}