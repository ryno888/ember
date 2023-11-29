<?php

namespace Kwerqy\Ember\com\release;

/**
 * @package Kwerqy\Ember\com\release
 * @author Ryno Van Zyl
 * @copyright Copyright Kwerqy. All rights reserved.
 */
class release extends \Kwerqy\Ember\com\intf\standard {
    
    private static $dir = APPPATH."Libraries/release";
    public static $class_arr = [];
    
    //--------------------------------------------------------------------------------
    public function __construct($options = []) {
        $this->load_classes();
    }
    //--------------------------------------------------------------------------------
    private static function load_classes() {

        if(self::$class_arr) return self::$class_arr;

        $file_arr = glob(self::$dir."/*");
        
        foreach ($file_arr as $file){

            $classname = str_replace(".php", "", basename($file));
            /**
             * @var $instance \Kwerqy\Ember\com\release\intf\release
             */
            $instance = call_user_func(["\\release\\{$classname}", "make"]);

            self::$class_arr[$instance->get_code()] = $instance;
        }
        
    }
    //--------------------------------------------------------------------------------
    /**
     * @param $code
     * @return mixed | \Kwerqy\Ember\com\release\intf\release
     */
    public static function get_instance($code) {

        if(!self::$class_arr) self::load_classes();

        if(isset(self::$class_arr[$code]))
            return self::$class_arr[$code];

    }
    //--------------------------------------------------------------------------------
    /**
     * @param $code
     */
    public static function is_active($code):bool {
        
        $instance = self::get_instance($code);

        if($instance) return $instance->is_active();

        return false;
    }
    //--------------------------------------------------------------------------------
}