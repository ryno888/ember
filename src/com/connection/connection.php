<?php

namespace Kwerqy\Ember\com\connection;

/**
 * @package mod\debug
 * @author Ryno Van Zyl
 */
class connection extends \Kwerqy\Ember\com\connection\intf\connection {
	//--------------------------------------------------------------------------------
	/**
	 * @param array $options
	 * @return \CodeIgniter\Database\BaseConnection
	 */
	public static function get_connection($options = []) {

		return \Config\Database::connect();
	}
	//--------------------------------------------------------------------------------
}