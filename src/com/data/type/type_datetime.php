<?php

namespace Kwerqy\Ember\com\data\type;

/**
 * Class data
 * @package app
 * @author Ryno Van Zyl
 */

class type_datetime extends \Kwerqy\Ember\com\data\type\intf\standard {

    //--------------------------------------------------------------------------------
	// properties
	//--------------------------------------------------------------------------------
	protected $name = "Date";
	protected $datatype = "string";
	protected $default = null;
	protected $type = TYPE_DATETIME;
	//--------------------------------------------------------------------------------
	// static
	//--------------------------------------------------------------------------------
	/**
	 * @param $value
	 * @param array $options
	 * @return bool|string|null
	 */
    public function parse($value, $options = []) {

    	$options = array_merge([
    	    "format" => false
    	], $options);

    	try{
    		return \Kwerqy\Ember\com\date\date::strtodatetime($value, $options["format"], $options);
		}catch(\Exception $ex){
			return $this->default;
		}
    }
    //--------------------------------------------------------------------------------
    function get_dbvalue(): string {
        return "DATETIME";
    }
    //--------------------------------------------------------------------------------

}
