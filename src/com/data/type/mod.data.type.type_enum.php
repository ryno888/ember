<?php

namespace Kwerqy\Ember\com\data\type;

/**
 * Class data
 * @package app
 * @author Ryno Van Zyl
 */

class type_enum extends \Kwerqy\Ember\com\data\type\intf\standard {

    //--------------------------------------------------------------------------------
	// properties
	//--------------------------------------------------------------------------------
	protected $name = "Enum";
	protected $datatype = "enum";
	protected $default = 0;
	protected $type = TYPE_ENUM;
	//--------------------------------------------------------------------------------
	// static
	//--------------------------------------------------------------------------------
	/**
	 * @param $value
	 * @param array $options
	 * @return int
	 */
    public function parse($value, $options = []) {

    	return type_int::make()->parse($value);

    }
    //--------------------------------------------------------------------------------
    function get_dbvalue(): string {
        return "TINYINT";
    }
    //--------------------------------------------------------------------------------

}
