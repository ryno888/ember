<?php

namespace Kwerqy\Ember\com\db;

/**
 * @package mod\debug
 * @author Ryno Van Zyl
 */
class meta extends \Kwerqy\Ember\com\intf\standard {

	/**
	 * @var \CodeIgniter\Database\BaseConnection
	 */
	protected $connection;

	/**
	 * @var coder|\Kwerqy\Ember\com\intf\standard
	 */
	protected $coder;

	//--------------------------------------------------------------------------------
	public function __construct() {
		$this->connection = \Kwerqy\Ember\com\connection\connection::get_connection();
//		$this->coder = \Kwerqy\Ember\com\db\coder\db_to_php::make();
	}
	//--------------------------------------------------------------------------------
	public function get_tables() {
		return $this->connection->listTables();
	}
	//--------------------------------------------------------------------------------
	public function get_table_fields($table) {
		return $this->connection->getFieldData($table);
	}
	//--------------------------------------------------------------------------------
//	public function run() {
//		foreach ($this->get_tables() as $table){
//
//			$field_data_arr = $this->get_table_fields($table);
//			$first_field = reset($field_data_arr);
//			$prefix = substr($first_field->name, 0, 3);
//
//			$this->coder->set_prefix($prefix);
//			$this->coder->set_key("{$prefix}_id");
//			$this->coder->set_name($table);
//			$this->coder->set_display_name(\Kwerqy\Ember\com\str\str::propercase(str_replace("_", " ", $table)));
//			$this->coder->set_display_field("{$prefix}_");
//
//			$field_data_arr = $this->get_table_fields($table);
//			foreach ($field_data_arr as $field_data){
//				$display_name = \Kwerqy\Ember\com\str\str::propercase(str_replace("_", " ", str_replace("{$prefix}_", "", $field_data->name)));
//				$type = strtoupper("TYPE_{$field_data->type}");
//				$default = is_null($field_data->default) ? "null" : $field_data->default;
//				$reference = strpos($field_data->name, "{$prefix}_ref") !== false ? str_replace("{$prefix}_ref_", "", '"'.$field_data->name.'"') : null;
//				$this->coder->add_field($field_data->name, $display_name, $type, $default, $reference);
//			}
//
//			$this->coder->run();
//		}
//	}
	//--------------------------------------------------------------------------------
}