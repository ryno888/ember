<?php

namespace Kwerqy\Ember\com\data\type;

/**
 * Class data
 * @package app
 * @author Ryno Van Zyl
 */

class type_string extends \Kwerqy\Ember\com\data\type\intf\standard {

    //--------------------------------------------------------------------------------
	// properties
	//--------------------------------------------------------------------------------
	protected $name = "String";
	protected $datatype = "string";
	protected $default = "";
	protected $type = TYPE_STRING;
	//--------------------------------------------------------------------------------
	// static
	//--------------------------------------------------------------------------------
	/**
	 * @param $value
	 * @param array $options
	 * @return int
	 */
    public function parse($value, $options = []) {
        return $value;
    }
    //--------------------------------------------------------------------------------
    function get_dbvalue(): string {
        return "VARCHAR";
    }
    //--------------------------------------------------------------------------------
}
