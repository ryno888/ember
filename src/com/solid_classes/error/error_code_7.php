<?php

namespace Kwerqy\Ember\com\solid_classes\error;

/**
 * @package mod\debug
 * @author Ryno Van Zyl
 */
class error_code_7 extends \Kwerqy\Ember\com\solid_classes\error\intf\error_code {
	//--------------------------------------------------------------------------------
	public function get_display_name(): string {
		return "Request error";
	}
	//--------------------------------------------------------------------------------
	public function get_description(): string {
		return "Your request does not exist or it has expired.";
	}
	//--------------------------------------------------------------------------------
	public function get_code(): string {
		return "ERROR_CODE_REQUEST_ERROR";
	}
	//--------------------------------------------------------------------------------
	public function get_value(): int {
		return 7;
	}
	//--------------------------------------------------------------------------------
	public function get_data_type() {
		return TYPE_INT;
	}
	//--------------------------------------------------------------------------------
}