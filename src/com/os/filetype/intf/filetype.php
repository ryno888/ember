<?php

namespace Kwerqy\Ember\com\os\filetype\intf;

/**
 * @package mod\debug
 * @author Ryno Van Zyl
 */
abstract class filetype extends \Kwerqy\Ember\com\intf\standard {
	//--------------------------------------------------------------------------------
    abstract public function get_extension():string;
    abstract public function get_mimetype():string;
	//--------------------------------------------------------------------------------
}