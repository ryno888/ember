<?php

namespace Kwerqy\Ember\com\session\intf;

/**
 * @package mod\debug
 * @author Ryno Van Zyl
 */
abstract class session_helper extends \Kwerqy\Ember\com\intf\standard {

    protected $name = false;

    /**
     * @var \Kwerqy\Ember\com\session\session
     */
    protected $com_session = false;

    protected $instance = false;

    //--------------------------------------------------------------------------
    //properties
    //--------------------------------------------------------------------------
    protected function __construct($options = []) {

        $options = array_merge([
            "name" => false
        ], $options);

        if(!$options["name"]) $options["name"] = str_replace("\\", "_", get_called_class());

        $this->name = $options["name"];
        $this->com_session = \Kwerqy\Ember\Ember::$session;

        $this->init();
    }
    //--------------------------------------------------------------------------
    protected function on_update($options = []){}
    protected function on_clear($options = []){}
    protected function on_init($options = []){}

    //--------------------------------------------------------------------------
    protected function get_instance() {
        return $this;
    }
    //--------------------------------------------------------------------------------
    /**
     * make safe name
     * @param $key
     * @return mixed
     */
    protected function format_key($key){
        //make safe name
        return str_replace([".", "/", "\\"], "_", $key);

    }
    //--------------------------------------------------------------------------
    public function is_empty() {

        $class_vars = get_class_vars(get_called_class());
        $object_vars = get_object_vars($this);

        foreach ($class_vars as $key => $value){
            if(in_array($key, ["name", "com_session", "instance", "order", "singleton_arr", "is_singleton"])) continue;

            if($object_vars[$key] !== $class_vars[$key]) return false;
        }

        return true;

    }
    //--------------------------------------------------------------------------
    public function __set($name, $value) {

        //make safe name
        $name = $this->format_key($name);

        $this->{$name} = $value;
    }
    //--------------------------------------------------------------------------
    public function __get($name) {

        //make safe name
        $name = $this->format_key($name);

        if(isset($this->{$name})) return $this->{$name};
    }
    //--------------------------------------------------------------------------
    public function get($name, $default = false) {

        //make safe name
        $name = $this->format_key($name);

        //evaluate and return default
		if (!isset($this->{$name})) return $this->{$name} = $default;

		//return
		return $this->{$name};
	}

    //--------------------------------------------------------------------------
    private function init(){

    	$this->on_init();

        $this->instance = $this->com_session->get($this->name);
        if($this->instance) $this->merge();
    }
    //--------------------------------------------------------------------------
    private function merge() {
        $session_properties = $this->instance ? get_object_vars($this->instance) : [];
        foreach ($session_properties as $property => $value) {
            $this->get_instance()->{$property} = $value;
        }
    }
    //--------------------------------------------------------------------------
    public function update($options = []){
    	$this->on_update($options);
        $this->com_session->set($this->name, $this);
        
        return $this;
    }
    //--------------------------------------------------------------------------

    /**
     * @param array $options
     * @return \Kwerqy\Ember\com\intf\standard|session_helper|static
     */
    public static function make($options = []) {
        $obj = parent::make($options);
        $obj->update();

        return $obj;
    }
    //--------------------------------------------------------------------------
    public function clear($options = []){

        $this->on_clear($options);

        //unset session
        if(isset($_SESSION[$this->name])){
            unset($_SESSION[$this->name]);
            unset($this->com_session->{$this->name});
        }

        //set defaults
        $default_arr = get_class_vars(get_called_class());
        foreach ($default_arr as $property => $default){
            $this->{$property} = $default;
        }

        self::make();
    }
    //--------------------------------------------------------------------------
}