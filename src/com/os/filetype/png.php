<?php

namespace Kwerqy\Ember\com\os\filetype;

/**
 * @package mod\debug
 * @author Ryno Van Zyl
 */
class png extends \Kwerqy\Ember\com\os\filetype\intf\filetype {

    // init
	//--------------------------------------------------------------------------------
	public function get_name(): string {
		return "PNG";
	}
	//--------------------------------------------------------------------------------
	public function get_extension(): string {
		return "png";
	}
	//--------------------------------------------------------------------------------
	public function get_mimetype(): string {
		return "image/png";
	}
	//--------------------------------------------------------------------------------
}