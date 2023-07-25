<?php

namespace Kwerqy\Ember\com\solid_classes\error;

/**
 * @package mod\debug
 * @author Ryno Van Zyl
 */
class error_code_6 extends \Kwerqy\Ember\com\solid_classes\error\intf\error_code {
	//--------------------------------------------------------------------------------
	public function get_display_name(): string {
		return "You have an active session";
	}
	//--------------------------------------------------------------------------------
	public function get_description(): string {
		return "You are already logged in, please logout first.";
	}
	//--------------------------------------------------------------------------------
	public function get_code(): string {
		return "ERROR_CODE_ACTIVE_SESSION";
	}
	//--------------------------------------------------------------------------------
	public function get_value(): int {
		return 6;
	}
	//--------------------------------------------------------------------------------
	public function get_data_type() {
		return TYPE_INT;
	}
	//--------------------------------------------------------------------------------
}