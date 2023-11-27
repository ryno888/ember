<?php

namespace Kwerqy\Ember\com\data\type;

/**
 * Class data
 * @package app
 * @author Ryno Van Zyl
 */

class type_reference extends \Kwerqy\Ember\com\data\type\intf\standard {

    //--------------------------------------------------------------------------------
	// properties
	//--------------------------------------------------------------------------------
	protected $name = "Reference";
	protected $datatype = "integer";
	protected $default = "null";
	protected $type = TYPE_INT;
	//--------------------------------------------------------------------------------
	// static
	//--------------------------------------------------------------------------------
	/**
	 * @param $value
	 * @param array $options
	 * @return int
	 */
    public function parse($value, $options = []) {

    	if(\Kwerqy\Ember\isnull($value)) return $this->default;
    	
    	//break apart
    	$parts_arr = explode(".", $value);

    	//clean parts from characters
    	foreach ($parts_arr as $key => $part){
    		$parts_arr[$key] = \Kwerqy\Ember\com\str\str::replace($part, [
				"/[^0-9]/" => "",
			]);
		}

    	//rebuild
    	$reset = $parts_arr ? implode("", $parts_arr) : "";
    	$end = array_pop($parts_arr);

    	if($reset) $result = intval("$reset.$end");
    	else $result = intval($end);

    	return (int)$result;

    }
    //--------------------------------------------------------------------------------
    function get_dbvalue(): string {
        return "INT";
    }
    //--------------------------------------------------------------------------------
}
