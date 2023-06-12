<?php

namespace Kwerqy\Ember\com\data\type;

/**
 * Class data
 * @package app
 * @author Ryno Van Zyl
 */

class type_file extends \Kwerqy\Ember\com\data\type\intf\standard {

    //--------------------------------------------------------------------------------
	// properties
	//--------------------------------------------------------------------------------
	protected $name = "File";
	protected $datatype = "string";
	protected $default = false;
	protected $type = TYPE_FILE;
	//--------------------------------------------------------------------------------
	// static
	//--------------------------------------------------------------------------------
	/**
	 * @param $value
	 * @param array $options
	 * @return bool
	 */
    public function parse($value, $options = []) {

        // sanitize as string
    	$value = \mod\data::parse($value, TYPE_STRING, $options);

    	// only allow filename
    	$value = basename($value);

		// sanitize as filename
		$value = preg_replace("/[^a-z0-9 !@#%&}';,=_\\+\\-\\.\\$\\^\\(\\)\\{\\[\\]]/i", "", $value);

		// trim
		$value = trim($value);

    	// done
    	return $value;

    }
    //--------------------------------------------------------------------------------
    function get_dbvalue(): string {
        return "LONGTEXT";
    }
    //--------------------------------------------------------------------------------

}
