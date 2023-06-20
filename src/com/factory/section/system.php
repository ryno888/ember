<?php
namespace Kwerqy\Ember\com\factory\section;

class system extends \Kwerqy\Ember\com\intf\section {
    //--------------------------------------------------------------------------------
	public function get_set() {
		return "system";
	}
	//--------------------------------------------------------------------------------
    public function get_layout() {
        return "system";
    }
	//--------------------------------------------------------------------------------
    /**
     * @param array $options
     * @return \Kwerqy\Ember\com\ui\intf\set
     */
	public function get_ui($options = []) {
		return \Kwerqy\Ember\com\ui\set\system::make($options);
	}
    //--------------------------------------------------------------------------------
}