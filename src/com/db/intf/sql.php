<?php

namespace Kwerqy\Ember\com\db\intf;

/**
 * @package mod\debug
 * @author Ryno Van Zyl
 */
abstract class sql extends \Kwerqy\Ember\com\intf\standard {

	//--------------------------------------------------------------------------------
	// internal
	//--------------------------------------------------------------------------------
	protected function is_mysql() {

		return (\Kwerqy\Ember\com\db::get_db_driver() == "MySQLi");
	}
	//--------------------------------------------------------------------------------
	protected function is_sqlsrv() {
		return (\Kwerqy\Ember\com\db::get_db_driver() == "sqlsrv");
	}
	//--------------------------------------------------------------------------------
}