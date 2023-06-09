<?php

namespace Kwerqy\Ember\com\os\filetype;

/**
 * @package mod\debug
 * @author Ryno Van Zyl
 */
class jpg extends \Kwerqy\Ember\com\os\filetype\intf\filetype {

    // init
	//--------------------------------------------------------------------------------
	public function get_name(): string {
		return "JPG";
	}
	//--------------------------------------------------------------------------------
	public function get_extension(): string {
		return "jpg";
	}
	//--------------------------------------------------------------------------------
	public function get_mimetype(): string {
		return "image/jpeg";
	}
	//--------------------------------------------------------------------------------
}