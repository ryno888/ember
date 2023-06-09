<?php

namespace Kwerqy\Ember\com\os\filetype;

/**
 * @package mod\debug
 * @author Ryno Van Zyl
 */
class tiff extends \Kwerqy\Ember\com\os\filetype\intf\filetype {

    // init
	//--------------------------------------------------------------------------------
	public function get_name(): string {
		return "TIFF";
	}
	//--------------------------------------------------------------------------------
	public function get_extension(): string {
		return "tiff";
	}
	//--------------------------------------------------------------------------------
	public function get_mimetype(): string {
		return "image/tiff";
	}
	//--------------------------------------------------------------------------------
}