<?php
namespace Kwerqy\Ember\com\solid_classes\intf;

/**
 * @package Kwerqy\Ember\com\solid_classes\product_property
 * @author Ryno Van Zyl
 * @copyright Copyright Liquid Edge Solutions. All rights reserved.
 */

abstract class dbrow extends standard {
	//--------------------------------------------------------------------------------
	public function get_data_arr():array { return []; }
	//--------------------------------------------------------------------------------
	public function get_data_arr_value($key, $options = []){
		$options = array_merge([
		    "default" => false
		], $options);

		$data_arr = $this->get_data_arr();

		return isset($data_arr[$key]) ? $data_arr[$key] : $options["default"];
	}
	//--------------------------------------------------------------------------------
	public function get_data_type_str() {
		return \Kwerqy\Ember\com\data\data::get_type_as_string($this->get_data_type());
	}
	//--------------------------------------------------------------------------------
	public function get_constant_string_name() {
		if(defined(strtoupper($this->get_key()))){
            $constant_str = $this->get_key();
        }else{
            $user_constant_arr = get_defined_constants(true)["user"];
            $constant_str = array_search($this->get_key(), $user_constant_arr);
        }
        return strtoupper($constant_str);
	}
	//--------------------------------------------------------------------------------
    public function get_generated_data_entry() {
    	$constant_str = $this->get_constant_string_name();
    	$solid_class_arr = \Kwerqy\Ember\com\solid_classes\library::$index_arr;

    	return isset($solid_class_arr[$constant_str]) ? $solid_class_arr[$constant_str] : [];
	}
	//--------------------------------------------------------------------------------
    /**
     * @return string
     */
	public function get_table_name(): string {
	    $called_class = get_called_class();

	    $parts = explode("\\", $called_class);

	    return $parts[sizeof($parts)-2];
	}
	//--------------------------------------------------------------------------------
    /**
     * @return string
     */
	public function get_form_id(): string {
		return strtolower($this->get_code());
	}
	//--------------------------------------------------------------------------------

	/**
	 * @param $value
	 * @return bool
	 */
	public function is_empty($value): bool {
		return $value == $this->get_default() || isempty($value);
	}
	//--------------------------------------------------------------------------------
}
