<?php

namespace Kwerqy\Ember\com\str;

/**
 * @package mod\debug
 * @author Ryno Van Zyl
 */
class uid extends \Kwerqy\Ember\com\intf\standard {

	protected $data_arr = [];
 	//--------------------------------------------------------------------------------
 	// functions
	//--------------------------------------------------------------------------------
    public function add_data($str) {
        $this->data_arr[] = $str;
    }
	//--------------------------------------------------------------------------------
    public function build($options = []) {
        return md5(implode("", $this->data_arr));
    }
	//--------------------------------------------------------------------------------
}