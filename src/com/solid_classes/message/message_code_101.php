<?php

namespace Kwerqy\Ember\com\solid_classes\message;

/**
 * @package mod\debug
 * @author Ryno Van Zyl
 */
class message_code_101 extends \Kwerqy\Ember\com\solid_classes\intf {
	//--------------------------------------------------------------------------------
	public function get_display_name(): string {
		return "Quote Submitted Successfully";
	}
	//--------------------------------------------------------------------------------
	public function get_description(): string {
		return "Thank you for submitting your quote. We will be in contact with you shortly.";
	}
	//--------------------------------------------------------------------------------
	public function get_code(): string {
		return "MESSAGE_CODE_101";
	}
	//--------------------------------------------------------------------------------
	public function get_value(): int {
		return 101;
	}
	//--------------------------------------------------------------------------------
	public function get_data_type() {
		return TYPE_INT;
	}
	//--------------------------------------------------------------------------------
}