<?php

namespace Kwerqy\Ember\com\solid_classes\user_role;

/**
 * @package mod\debug
 * @author Ryno Van Zyl
 */
class admin extends \Kwerqy\Ember\com\solid_classes\user_role\intf\user_role {
	//--------------------------------------------------------------------------------
	public function get_display_name(): string {
		return "Admin User";
	}
	//--------------------------------------------------------------------------------
	public function get_description(): string {
		return "User has administrative rights in the system";
	}
	//--------------------------------------------------------------------------------
	public function get_code(): string {
		return "USER_ROLE_ADMIN";
	}
	//--------------------------------------------------------------------------------
	public function get_value(): string {
		return "ADMIN";
	}
	//--------------------------------------------------------------------------------
    public function get_level(): int {
	    return 3;
    }
	//--------------------------------------------------------------------------------
}