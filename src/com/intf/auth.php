<?php

namespace Kwerqy\Ember\com\intf;

/**
 * @package mod\intf
 * @author Ryno Van Zyl
 */
abstract class auth extends standard {

	//--------------------------------------------------------------------------------
    public function check($role): bool {
        $role_access_arr = $this->get_role_access_arr();

        if(!$role_access_arr) return true;
        else if($role && in_array($role, $role_access_arr)){
            return true;
        }
        return false;
    }
	//--------------------------------------------------------------------------------
    abstract public function get_role_access_arr();
	//--------------------------------------------------------------------------------
}