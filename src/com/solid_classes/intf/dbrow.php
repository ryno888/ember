<?php
namespace Kwerqy\Ember\com\solid_classes\intf;

/**
 * @package Kwerqy\Ember\com\solid_classes\product_property
 * @author Ryno Van Zyl
 * @copyright Copyright Liquid Edge Solutions. All rights reserved.
 */

abstract class dbrow extends standard {
	//--------------------------------------------------------------------------------

	/**
	 * The GS1 key of the property
	 * @return string
	 */
	abstract public function get_key();
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

    /**
     * Parses the value to the appropriate data type
     * @param $mixed
     * @param array $options
     * @return mixed|string
     */
	public function parse($mixed, $options = []){

		switch ($this->get_data_type()){
			case TYPE_ENUM: return isset($this->get_data_arr()[$mixed]) ? $this->get_data_arr()[$mixed] : $options["default"];
			default: return \Kwerqy\Ember\com\data\data::parse($mixed, $this->get_data_type(), $options);
		}
		
	}
	//--------------------------------------------------------------------------------
	/**
	 * @param $mixed
	 * @return mixed
	 */
	public function format($mixed, $options = []){
		$options = array_merge([
		    "default" => $this->get_default()
		], $options);

		switch ($this->get_data_type()){
			case TYPE_BOOL: return $mixed ? "Yes" : "No";
			case TYPE_CURRENCY: return \com\num::currency($this->parse($mixed));
			case TYPE_ENUM: return isset($this->get_data_arr()[$mixed]) ? $this->get_data_arr()[$mixed] : $options["default"];
			default: return $this->parse($mixed);
		}
	}
	//--------------------------------------------------------------------------------
}
