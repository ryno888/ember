<?php

namespace Kwerqy\Ember\com\intf;

/**
 * @package mod\intf
 * @author Ryno Van Zyl
 */
abstract class section extends \Kwerqy\Ember\com\intf\standard{

	//--------------------------------------------------------------------------------
	/**
	 * @return string|\Kwerqy\Ember\com\ui\intf\set
	 */
	public abstract function get_set();
	//--------------------------------------------------------------------------------
	/**
	 * @return string
	 */
	public abstract function get_layout();
	//--------------------------------------------------------------------------------
    public function get_name() {
        $called_class = get_called_class();
        $called_class_parts = explode("\\", $called_class);
        return end($called_class_parts);
    }
    //--------------------------------------------------------------------------------

    /**
     * @param array $options
     * @return \Kwerqy\Ember\com\ui\intf\set
     */
	public abstract function get_ui($options = []);
	//--------------------------------------------------------------------------------
}