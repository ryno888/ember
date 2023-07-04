<?php

namespace Kwerqy\Ember\com\solid_classes\user_role\intf;

/**
 * @package mod\debug
 * @author Ryno Van Zyl
 */
abstract class user_role extends \Kwerqy\Ember\com\solid_classes\intf {
	//--------------------------------------------------------------------------------
    abstract public function get_level():int;
	//--------------------------------------------------------------------------------
	public function get_data_type() {
		return TYPE_STRING;
	}
	//--------------------------------------------------------------------------------
    public function __destruct() {

	    if(!\Kwerqy\Ember\Ember::is_db_enabled()) return;

        $acl_code_arr = \Kwerqy\Ember\Ember::$session->get("acl_role_arr", ["default" => []]);
        if(!array_key_exists($this->get_code(), $acl_code_arr)){
            $acl_role = \Kwerqy\Ember\Ember::dbt("acl_role")->find([
                ".acl_code" => $this->get_code(),
                "create" => true,
            ]);

            if($acl_role->source != "database"){
                $acl_role->acl_name = $this->get_display_name();
                $acl_role->acl_code = $this->get_code();
                $acl_role->acl_level = $this->get_level();
                $acl_role->acl_is_locked = 1;
                $acl_role->save();
            }

            $acl_code_arr[$this->get_code()] = $acl_role;
            \Kwerqy\Ember\Ember::$session->set("acl_role_arr", $acl_code_arr);
        }
    }
    //--------------------------------------------------------------------------------
}