<?php

namespace Kwerqy\Ember\com\auth;

/**
 * @package mod\debug
 * @author Ryno Van Zyl
 */
class token extends \Kwerqy\Ember\com\intf\standard {
    //--------------------------------------------------------------------------------
    public function get_active_role() {
        return \Kwerqy\Ember\Ember::$user->active_role;
    }
    //--------------------------------------------------------------------------------
    public function get_active_user() {
        return \Kwerqy\Ember\Ember::$user->active_user;
    }
    //--------------------------------------------------------------------------------
    /**
     * @param $class
     * @return false
     */
    public function check($class) {

        $access = false;
        
        if(file_exists(APPPATH."Libraries/access/{$class}.php")){
            $access = call_user_func(["\\access\\{$class}", "make"]);
        }
        
        if(!$access && file_exists(DIR_COM."/auth/access/{$class}.php")){
            $access = call_user_func(["\\Kwerqy\\Ember\\com\\auth\\access\\{$class}", "make"]);
        }

        return $access ? $access->check($this) : false;
    }
    //--------------------------------------------------------------------------------
}