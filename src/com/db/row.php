<?php

namespace Kwerqy\Ember\com\db;

/**
 * @package mod\debug
 * @author Ryno Van Zyl
 */
class row {

	/**
	 * @var \Kwerqy\Ember\com\db\intf\table
	 */
	protected $instance;
	public $source;

	public $id;
	public $name;

	//--------------------------------------------------------------------------------
	public function __construct($instance, $source) {
		$this->instance = $instance;
		$this->source = $source;
	}
	//--------------------------------------------------------------------------------

	/**
	 * @param $name
	 * @return intf\table|row
	 * @throws \Exception
	 */
	public function __get($name) {

		if($name == "db") return $this->instance;
		if($name == "id") return $this->{$this->instance->key};

		//check reference tables
		$reference_field = "{$this->instance->get_prefix()}_ref_{$name}";
		$field_data = $this->instance->get_field_data($reference_field);
		if($field_data && !property_exists($this, $name)){
			if(\Kwerqy\Ember\isempty($this->{$reference_field})) return false;
			if(property_exists($this, $name)) return $this->{$name};
			 $this->{$name} = \Kwerqy\Ember\Ember::dbt($name)->get_fromdb(\Kwerqy\Ember\com\data\data::parse($this->{$reference_field}, TYPE_INT));
		}

		if(property_exists($this, $name)){
			return $this->{$name};
		}else{
			throw new \Exception("Field [$name] not found.");
		}
	}
	//--------------------------------------------------------------------------------
    /**
     * @param $name
     * @param $arguments
     * @return false|mixed
     * @throws \Exception
     */
  	public function __call($name, $arguments) {
  		if (method_exists($this->instance, $name)) {
  			$arguments = [-1 => $this] + \Kwerqy\Ember\com\arr\arr::splat($arguments);
			return call_user_func_array([$this->instance, $name], $arguments);
  		}
  		else throw new \Exception("Call to undefined function: $name");
  	}
	//--------------------------------------------------------------------------------

	/**
	 * @param $instance \Kwerqy\Ember\com\db\intf\table
	 * @param $source
	 * @return row|\Kwerqy\Ember\com\intf\standard|static
	 */
	public static function make($instance, $source) {
		return new static($instance, $source);
	}
	//--------------------------------------------------------------------------------
}