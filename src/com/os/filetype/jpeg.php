<?php

namespace Kwerqy\Ember\com\os\filetype;

/**
 * @package mod\debug
 * @author Ryno Van Zyl
 */
class jpeg extends \Kwerqy\Ember\com\os\filetype\intf\filetype {

    // init
	//--------------------------------------------------------------------------------
	public function get_name(): string {
		return "JPEG";
	}
	//--------------------------------------------------------------------------------
	public function get_extension(): string {
		return "jpeg";
	}
	//--------------------------------------------------------------------------------
	public function get_mimetype(): string {
		return "image/jpeg";
	}
	//--------------------------------------------------------------------------------
}