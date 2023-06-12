<?php

namespace Kwerqy\Ember\com\intf;

/**
 * @package mod\intf
 * @author Ryno Van Zyl
 */
abstract class section extends \Kwerqy\Ember\com\intf\standard{

	//--------------------------------------------------------------------------------
	/**
	 * @return string
	 */
	public abstract function get_set();
	//--------------------------------------------------------------------------------
	/**
	 * @return string
	 */
	public abstract function get_layout();
	//--------------------------------------------------------------------------------

    /**
     * @param array $options
     * @return mixed
     */
	public abstract function get_ui($options = []);
	//--------------------------------------------------------------------------------
}