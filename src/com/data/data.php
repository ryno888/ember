<?php

namespace Kwerqy\Ember\com\data;

/**
 * Class data
 * @package app
 * @author Ryno Van Zyl
 */

class data{

    //--------------------------------------------------------------------------------
	// properties
	//--------------------------------------------------------------------------------


	//--------------------------------------------------------------------------------
	// static
	//--------------------------------------------------------------------------------
    public static function parse($value, $type, $options = []) {
        return self::get_class($type)->parse($value);
    }
    //--------------------------------------------------------------------------------
    /**
     * @param $type
     * @return \Kwerqy\Ember\com\data\type\intf\standard
     */
    public static function get_class($type) {

        switch ($type){
            case TYPE_REFERENCE:
            case TYPE_INT:
            case TYPE_ENUM:
            case TYPE_TINYINT:
            case TYPE_KEY:
                return \Kwerqy\Ember\com\data\type\type_int::make();

            case TYPE_BOOL:
                return \Kwerqy\Ember\com\data\type\type_bool::make();

            case TYPE_TELNR:
            case TYPE_EMAIL:
            case TYPE_VARCHAR:
            case TYPE_STRING:
                return \Kwerqy\Ember\com\data\type\type_string::make();

            case TYPE_DATE:
                return \Kwerqy\Ember\com\data\type\type_date::make();

            case TYPE_DATETIME:
                return \Kwerqy\Ember\com\data\type\type_datetime::make();

            case TYPE_TEXT:
            case TYPE_LONGBLOB:
            case TYPE_FILE:
                return \Kwerqy\Ember\com\data\type\type_text::make();

            case TYPE_DOUBLE:
            case TYPE_DECIMAL:
            case TYPE_FLOAT:
                return \Kwerqy\Ember\com\data\type\type_float::make();
        }
    }
    //--------------------------------------------------------------------------------
	public static function is_valid_email($email) {
		if (filter_var($email, FILTER_VALIDATE_EMAIL)) {

			if(!preg_match("/^[a-zA-Z0-9_.-]+@[a-zA-Z0-9-]+.[a-zA-Z0-9-.]+$/", $email)){
				return false;
			}

			$email_arr = explode("@", $email);
            if (!checkdnsrr(array_pop($email_arr), "MX")) {
                return false;
            }
		}

		return true;
	}
    //--------------------------------------------------------------------------------

}
