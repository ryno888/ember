<?php

namespace Kwerqy\Ember\com\os\filetype;

/**
 * @package mod\debug
 * @author Ryno Van Zyl
 */
class gif extends \Kwerqy\Ember\com\os\filetype\intf\filetype {

    // init
	//--------------------------------------------------------------------------------
	public function get_name(): string {
		return "GIF";
	}
	//--------------------------------------------------------------------------------
	public function get_extension(): string {
		return "gif";
	}
	//--------------------------------------------------------------------------------
	public function get_mimetype(): string {
		return "image/gif";
	}
	//--------------------------------------------------------------------------------
}