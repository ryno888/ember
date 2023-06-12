<?php

namespace Kwerqy\Ember\com\data\type\intf;

/**
 * Class data
 * @package app
 * @author Ryno Van Zyl
 */

abstract class standard extends \Kwerqy\Ember\com\intf\standard {

    //--------------------------------------------------------------------------------
	// properties
	//--------------------------------------------------------------------------------
	protected $name;
	protected $default;
	protected $datatype;
	protected $type;
	//--------------------------------------------------------------------------------
	// methods
	//--------------------------------------------------------------------------------
    abstract function parse($value, $options = []);
    //--------------------------------------------------------------------------------
    abstract function get_dbvalue() : string;
    //--------------------------------------------------------------------------------

}
