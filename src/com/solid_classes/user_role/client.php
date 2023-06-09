<?php

namespace Kwerqy\Ember\com\solid_classes\user_role;

/**
 * @package mod\debug
 * @author Ryno Van Zyl
 */
class client extends \Kwerqy\Ember\com\solid_classes\user_role\intf\user_role {
	//--------------------------------------------------------------------------------
	public function get_display_name(): string {
		return "Client";
	}
	//--------------------------------------------------------------------------------
	public function get_description(): string {
		return "Client User";
	}
	//--------------------------------------------------------------------------------
	public function get_code(): string {
		return "USER_ROLE_CLIENT";
	}
	//--------------------------------------------------------------------------------
	public function get_value(): string {
		return "CLIENT";
	}
	//--------------------------------------------------------------------------------
    public function get_level(): int {
	    return 10;
    }
	//--------------------------------------------------------------------------------
}