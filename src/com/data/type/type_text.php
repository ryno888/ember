<?php

namespace Kwerqy\Ember\com\data\type;

/**
 * Class data
 * @package app
 * @author Ryno Van Zyl
 */

class type_text extends \Kwerqy\Ember\com\data\type\intf\standard {

    //--------------------------------------------------------------------------------
	// properties
	//--------------------------------------------------------------------------------
	protected $name = "Text";
	protected $datatype = "text";
	protected $default = "";
	protected $type = TYPE_TEXT;
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
        return "TEXT";
    }
    //--------------------------------------------------------------------------------
}
