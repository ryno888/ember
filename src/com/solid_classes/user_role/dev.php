<?php

namespace Kwerqy\Ember\com\solid_classes\user_role;

/**
 * @package mod\debug
 * @author Ryno Van Zyl
 */
class dev extends \Kwerqy\Ember\com\solid_classes\user_role\intf\user_role {
	//--------------------------------------------------------------------------------
	public function get_display_name(): string {
		return "Developer User";
	}
	//--------------------------------------------------------------------------------
	public function get_description(): string {
		return "User has development rights in the system";
	}
	//--------------------------------------------------------------------------------
	public function get_code(): string {
		return "USER_ROLE_DEV";
	}
	//--------------------------------------------------------------------------------
	public function get_value(): string {
		return "DEV";
	}
	//--------------------------------------------------------------------------------
    public function get_level(): int {
	    return 1;
    }
	//--------------------------------------------------------------------------------
}