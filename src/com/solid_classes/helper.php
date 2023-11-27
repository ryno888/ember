<?php

namespace Kwerqy\Ember\com\solid_classes;

/**
 * @package mod\debug
 * @author Ryno Van Zyl
 */
class helper extends \Kwerqy\Ember\com\intf\standard {

	public static $solid_class_arr = [];

	//--------------------------------------------------------------------------------
	protected function __construct($options = []) {

		if(file_exists(DIR_LIBRARIES."/incl/library.php"))
			self::$solid_class_arr = \incl\library::$index_arr;

	}
	//--------------------------------------------------------------------------------

	/**
	 * @param $key
	 * @param array $options
	 * @return mixed|string[]|null|\Kwerqy\Ember\com\solid_classes\intf\standard|\Kwerqy\Ember\com\solid_classes\intf\dbrow
	 */
	protected function get_instance_data($key, $options = []) {

		if(!isset(self::$solid_class_arr[$key])) return null;

		return self::$solid_class_arr[$key];

	}
	//--------------------------------------------------------------------------------
	/**
	 * @param $namespace
	 * @param $name
	 * @return false|mixed|\mod\solid_classes\intf
	 */
	public function get($namespace, $name) {
		try{
			$class = "\\Kwerqy\\Ember\\com\\solid_classes\\{$namespace}\\{$name}";
			return call_user_func([$class, "make"]);
		}catch(\Exception $ex){
			\Kwerqy\Ember\com\error\error::create($ex->getMessage(), ["fatal" => true]);
		}
	}
	//--------------------------------------------------------------------------------

	/**
	 * @param $key
	 * @param array $options
	 * @return mixed|string[]|null|\Kwerqy\Ember\com\solid_classes\intf\standard|\Kwerqy\Ember\com\solid_classes\intf\dbrow
	 */
	public function get_instance($key, $options = []) {

		$instance_data = $this->get_instance_data($key, $options);

		if(!$instance_data) return null;

		$instance_data["instance"] = call_user_func([$instance_data["classname"], "make"]);

		return $instance_data ? $instance_data["instance"] : false;

	}
	//--------------------------------------------------------------------------------
	/**
	 * @param $constant
	 * @return false|mixed|\Kwerqy\Ember\com\solid_classes\intf\standard
	 */
	public function get_from_constant(string $constant) {

	    if(file_exists(APPPATH."Libraries/incl/library.php")){
            $arr = \incl\library::make()->index_arr;
            if(isset($arr[strtoupper($constant)])){
                $data = $arr[strtoupper($constant)];
                return $this->get_from_classname($data["classname"]);
            }
        }
	}
	//--------------------------------------------------------------------------------

	/**
	 * @param $classname
	 * @return false|mixed|\mod\solid_classes\intf
	 */
	public function get_from_classname($classname) {
		return call_user_func([$classname, "make"]);
	}
	//--------------------------------------------------------------------------------
}