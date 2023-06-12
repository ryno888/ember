<?php
namespace Kwerqy\Ember\com\factory\section;

class bootstrap extends \Kwerqy\Ember\com\intf\section {
    //--------------------------------------------------------------------------------
	public function get_set() {
		return "bootstrap";
	}
	//--------------------------------------------------------------------------------
    public function get_layout() {
        return "bootstrap";
    }
	//--------------------------------------------------------------------------------
    /**
     * @param array $options
     * @return \Kwerqy\Ember\com\intf\standard|\Kwerqy\Ember\com\ui\set\bootstrap|mixed
     */
	public function get_ui($options = []) {
		return \Kwerqy\Ember\com\ui\set\bootstrap::make($options);
	}
    //--------------------------------------------------------------------------------
}