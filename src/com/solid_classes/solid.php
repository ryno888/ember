<?php

namespace Kwerqy\Ember\com\solid_classes;

/**
 * @package app
 * @author Ryno Van Zyl
 * @copyright Copyright Liquid Edge Solutions. All rights reserved.
 */

class solid extends \Kwerqy\Ember\com\intf\standard {

    /**
     * @var solid\property_set\helper|\com\intf\standard|null
     */
    public $helper = null;

    //--------------------------------------------------------------------------------
    public static function get_instance($key, $options = []) {
    	$constant_str = self::get_constant_string_name($key);
        return helper::make()->get_instance($constant_str, $options);
 	}
    //--------------------------------------------------------------------------------
    public static function get_constant_string_name($mixed) {

        if(defined(strtoupper($mixed))){
            $constant_str = $mixed;
        }else{
            $user_constant_arr = get_defined_constants(true)["user"];
            $constant_str = "";
            array_walk($user_constant_arr, function($value, $key)use($mixed, &$constant_str){
            	if($value === $mixed) return $constant_str = $key;
			});
        }

        return strtoupper($constant_str);
    }
    //--------------------------------------------------------------------------------
    public static function get_generated_data_entry($key) {
    	$constant_str = self::get_constant_string_name($key);
    	$solid_class_arr = \app\solid\property_set\incl\library::$solid_arr;

    	return isset($solid_class_arr[$constant_str]) ? $solid_class_arr[$constant_str] : [];
	}
    //--------------------------------------------------------------------------------
    public static function get_data_arr($key, $options = []){
        $solid = self::get_instance($key);
        return $solid->get_data_arr();
    }
    //--------------------------------------------------------------------------------
    public static function request($key, $options = []){

        $solid = self::get_instance($key);

        $datatype = $solid->get_data_type();

        if($datatype == TYPE_ENUM)
        	$datatype = TYPE_STRING;

        $options = array_merge([
            "default" => $solid->get_default(),
            "datatype" => $datatype,
        ], $options);

        return \Kwerqy\Ember\Ember::$request->get($solid->get_form_id(), $options["datatype"], $options);
    }
    //--------------------------------------------------------------------------------
    public static function request_setting($key, $options = []){

        $solid = self::get_instance($key);

        $options = array_merge([
            "default" => $solid->get_default()
        ], $options);

        return \Kwerqy\Ember\Ember::$request->get($solid->get_form_id(), $solid->get_data_type(), $options);
    }
    //--------------------------------------------------------------------------------

    /**
     * @param $key
     * @return mixed|\app\solid\property_set\solid_classes\settings\intf\standard
     */
    public static function get_setting_instance_from_id($key) {
        return \app\solid::get_setting_instance(constant(strtoupper($key)));
 	}
    //--------------------------------------------------------------------------------

	/**
	 * @param $key
	 * @return string
	 */
    public static function get_form_id($key) {
    	$solid = self::get_instance($key);
        return $solid->get_form_id();
 	}
    //--------------------------------------------------------------------------------
    public static function install($options = []) {

        $options = array_merge([
            "install_db_class" => false
        ], $options);

        \Kwerqy\Ember\com\solid_classes\coder::make()->build_library();
        \Kwerqy\Ember\com\solid_classes\coder::make()->build_constants();
    }
    //--------------------------------------------------------------------------------
}