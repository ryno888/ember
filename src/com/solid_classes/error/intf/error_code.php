<?php

namespace Kwerqy\Ember\com\solid_classes\user_role\intf;

/**
 * @package mod\debug
 * @author Ryno Van Zyl
 */
abstract class error_code extends \Kwerqy\Ember\com\solid_classes\intf {
    //--------------------------------------------------------------------------------
	public function get_http_status_code(): int {
		return 500;
	}
    //--------------------------------------------------------------------------------
}