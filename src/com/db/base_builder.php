<?php

namespace Kwerqy\Ember\com\db;

/**
 * @package mod\debug
 * @author Ryno Van Zyl
 */
class base_builder extends \CodeIgniter\Database\BaseBuilder {
	//--------------------------------------------------------------------------------
	public function str_join($sql) {
		$this->QBJoin[] = $sql;
	}
	//--------------------------------------------------------------------------------
}