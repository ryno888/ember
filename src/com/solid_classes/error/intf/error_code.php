<?php

namespace Kwerqy\Ember\com\solid_classes\error\intf;

/**
 * @package mod\debug
 * @author Ryno Van Zyl
 */
abstract class error_code extends \Kwerqy\Ember\com\solid_classes\intf\standard {
    //--------------------------------------------------------------------------------
	public function get_http_status_code(): int {
		return 500;
	}
    //--------------------------------------------------------------------------------
}