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