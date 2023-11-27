<?php

namespace Kwerqy\Ember\com\solid_classes\message;

/**
 * @package mod\debug
 * @author Ryno Van Zyl
 */
class message_code_102 extends \Kwerqy\Ember\com\solid_classes\error\intf\error_code {
	//--------------------------------------------------------------------------------
	public function get_display_name(): string {
		return "Verification Email Sent";
	}
	//--------------------------------------------------------------------------------
	public function get_description(): string {
		return "We have sent you an mail. Please click the link to verify your email address.";
	}
	//--------------------------------------------------------------------------------
	public function get_code(): string {
		return "MESSAGE_CODE_102";
	}
	//--------------------------------------------------------------------------------
	public function get_value(): int {
		return 102;
	}
	//--------------------------------------------------------------------------------
	public function get_data_type() {
		return TYPE_INT;
	}
	//--------------------------------------------------------------------------------
}