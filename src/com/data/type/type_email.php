<?php

namespace Kwerqy\Ember\com\data\type;

/**
 * Class data
 * @package app
 * @author Ryno Van Zyl
 */

class type_email extends \Kwerqy\Ember\com\data\type\intf\standard {

    //--------------------------------------------------------------------------------
	// properties
	//--------------------------------------------------------------------------------
	protected $name = "Email";
	protected $datatype = "string";
	protected $default = "";
	protected $type = TYPE_EMAIL;
	//--------------------------------------------------------------------------------
	// static
	//--------------------------------------------------------------------------------
	/**
	 * @param $value
	 * @param array $options
	 * @return mixed
	 */
    public function parse($value, $options = []) {

    	$parts_arr = explode("@", $value);

    	$end = array_pop($parts_arr);
		$reset = $parts_arr ? implode("", $parts_arr) : "";

		$end_parts = explode(".", $end);
		foreach ($end_parts as $key => $end_part){
			$end_parts[$key] = \Kwerqy\Ember\com\str\str::strip_special_chars($end_part);
		}

    	$reset = \Kwerqy\Ember\com\str\str::strip_special_chars($reset);
    	$end = implode(".", $end_parts);

    	$value = "{$reset}@{$end}";

    	$result = filter_var($value, FILTER_SANITIZE_EMAIL);

    	return $result === false ? $this->default : $result;

    }
    //--------------------------------------------------------------------------------
    function get_dbvalue(): string {
        return "VARCHAR";
    }
    //--------------------------------------------------------------------------------

}
