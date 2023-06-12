<?php

namespace Kwerqy\Ember\com\cache;

/**
 * @package mod\debug
 * @author Ryno Van Zyl
 */
class cache extends \Kwerqy\Ember\com\intf\standard {

    /**
     * @var \CodeIgniter\Cache\CacheInterface|mixed
     */
    private $cache;
    private $cache_id;

    private int $timeout = 300;

    public $pool = [];

	//--------------------------------------------------------------------------------
    protected function __construct($options = []) {

        $options = array_merge([
            "cache_id" => \Kwerqy\Ember\com\str\str::generate_id()
        ], $options);

        $this->cache_id = $options["cache_id"];
        $this->cache = cache();


        $this->init();
    }
    //--------------------------------------------------------------------------------
    private function init(){
        //init
        $instance = $this->get_instance();
        if($instance) $this->pool = $instance->pool;
    }
    //--------------------------------------------------------------------------------
    /**
     * @return mixed|cache
     */
    private function get_instance(){
        return cache()->get($this->cache_id);
    }
    //--------------------------------------------------------------------------------
    private function update(){
        cache()->save($this->cache_id, $this, $this->timeout);
    }
    //--------------------------------------------------------------------------------
    public function __set($name, $value) {
        $this->add($name, $value);
    }
    //--------------------------------------------------------------------------------
    public function __get($name) {
        return $this->get($name);
    }
    //--------------------------------------------------------------------------------
    public function get($name, $options = []) {

        $options = array_merge([
            "default" => false,
        ], $options);

        if(isset($this->pool[$name]))
            return $this->pool[$name];

        return $options["default"];
    }
    //--------------------------------------------------------------------------------
    public function add($name, $value) {

        $this->pool[$name] = $value;
        $this->update();
    }
    //--------------------------------------------------------------------------------
    public function remove($name) {

        if(isset($this->pool[$name]))
            unset($this->pool[$name]);

        $this->update();
    }
    //--------------------------------------------------------------------------------
    /**
     * @return $this
     */
    public function clear() {

        $this->pool = [];
        $this->update();

        return $this;
    }
    //--------------------------------------------------------------------------------
}