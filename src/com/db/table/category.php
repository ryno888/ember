<?php

namespace Kwerqy\Ember\com\db\table;

/**
 * @author Ryno Van Zyl
 * @copyright Copyright Kwerqy. All rights reserved.
 */
class category extends \Kwerqy\Ember\com\db\intf\table {

	use \Kwerqy\Ember\com\db\tra\property_table;

    //--------------------------------------------------------------------------------
    // properties
    //--------------------------------------------------------------------------------
    public string $name = "category";
    public string $key = "cat_id";
    public string $display = "cat_name";
    
    public string $display_name = "category";
    public string $slug = "cat_slug";
    public string $property_table = "category_property";
    
    public array $field_arr = array(// FIELDNAME => DISPLAY[0] DEFAULT[1] TYPE[2] REFERENCE[3]
        // identification
        "cat_id"                        => array("id",                  "null",     TYPE_KEY),
        "cat_name"                      => array("Category Name",    	"",         TYPE_VARCHAR),
        "cat_ref_category"        		=> array("Parent Category",   	"null",     TYPE_REFERENCE, "category"),
        "cat_slug"                  	=> array("slug",            	"",         TYPE_VARCHAR),
        "cat_order"                  	=> array("order",            	0,          TYPE_INT),
    );
    //--------------------------------------------------------------------------------
    // events
    //--------------------------------------------------------------------------------
}