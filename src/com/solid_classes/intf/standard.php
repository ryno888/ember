<?php

namespace Kwerqy\Ember\com\solid_classes\intf;

/**
 * @package mod\debug
 * @author Ryno Van Zyl
 */
abstract class standard extends  \Kwerqy\Ember\com\intf\standard {
	//--------------------------------------------------------------------------------
	public function get_name(): string {
		return $this->get_display_name();
	}
	//--------------------------------------------------------------------------------
	/**
	 * The display name of the property
	 * @return string
	 */
	abstract public function get_display_name(): string;
	//--------------------------------------------------------------------------------

	/**
	 * This is an optional method that provides an in-depth description of the property
	 * Return a description
	 * @return string
	 */
	public function get_description():string{ return ""; }
	//--------------------------------------------------------------------------------

	/**
	 * The code used to build the constant
	 * @return string
	 */
	abstract public function get_code(): string;
	//--------------------------------------------------------------------------------
	public function get_key(){
		return $this->get_code();
	}
	//--------------------------------------------------------------------------------

	/**
	 * The GS1 key of the property
	 * @return mixed
	 */
	public function get_value(){ return $this->get_default(); }
	//--------------------------------------------------------------------------------

	/**
	 * The data type of the property
	 * @return mixed
	 */
	abstract public function get_data_type();
	//--------------------------------------------------------------------------------

	/**
	 * The default value of the property
	 * @return mixed
	 */
	public function get_default() {
		return \Kwerqy\Ember\com\data\data::parse("", $this->get_data_type());
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
     * Parses the value to the appropriate data type
     * @param $mixed
     * @param array $options
     * @return mixed|string
     */
	public function parse($mixed, $options = []){

		$options = array_merge([
		    "default" => $this->get_default()
		], $options);

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
			case TYPE_CURRENCY: return \Kwerqy\Ember\com\num\num::currency($this->parse($mixed));
			case TYPE_ENUM: return isset($this->get_data_arr()[$mixed]) ? $this->get_data_arr()[$mixed] : $options["default"];
			default: return $this->parse($mixed);
		}
	}
	//--------------------------------------------------------------------------------
}