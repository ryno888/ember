<?php

namespace Kwerqy\Ember\com\db;

/**
 * @package mod\debug
 * @author Ryno Van Zyl
 */
class db extends \Kwerqy\Ember\com\intf\standard {
	//--------------------------------------------------------------------------------
	/**
	 * @return mixed|\Config\Database
	 */
	public static function get_config() {
		return config('Database');
	}
	//--------------------------------------------------------------------------------
	/**
	 * @return mixed
	 */
	public static function get_db_driver() {
		return self::get_config()->default["DBDriver"];
	}
	//--------------------------------------------------------------------------------
    public function selectsingle($sql) {

		$result_arr = $this->select($sql);

		$result = reset($result_arr);

		if(is_array($result))
            return reset($result);
		else return false;
    }
	//--------------------------------------------------------------------------------
    public function selectlist($sql, $field1, $field2, $options = []) {

		$return_arr = [];

		if($sql instanceof \Kwerqy\Ember\com\db\sql\select)
		    $sql = $sql->build();

		$result_arr = $this->select($sql);

        foreach ($result_arr as $data){
            $return_arr[$data[$field1]] = $data[$field2];
        }

        return $return_arr;
    }
	//--------------------------------------------------------------------------------
    /**
     * @param $sql
     * @return array|array[]
     */
    public function select($sql): array {

        if($sql instanceof \Kwerqy\Ember\com\db\sql\select)
            $sql = $sql->build();

        $connection = \Kwerqy\Ember\com\connection\connection::get_connection();
		$query = $connection->query($sql);
		return $query->getResultArray();
    }
	//--------------------------------------------------------------------------------
	/**
	 * @return mixed
	 */
	public static function dbvalue($value, $options = []) {

		$options = array_merge([
			"wrap_quote" => "'",
			"skip_opentag" => false,
		], $options);

		$replace_arr = ["'" => "''", '<' => '&lt;', "\0" => ""];
		if ($options["skip_opentag"]) unset($replace_arr["<"]);
		return ($value === 'null' ? 'NULL' : $options["wrap_quote"].strtr($value, $replace_arr).$options["wrap_quote"]);
	}
	//--------------------------------------------------------------------------------

    /**
     * @param $field_arr
     * @param false $alias
     * @return string
     */
    public static function getsql_concat($field_arr, $alias = false) {

	    $sql = "CONCAT(".implode(", ", $field_arr).")";
	    if($alias) $sql = "{$sql} AS {$alias}";

        return $sql;
    }
	//--------------------------------------------------------------------------------
    public static function get_create_sql($table) {
        return \Kwerqy\Ember\com\db\coder\php_to_db::make()->get_create_sql($table);
    }
	//--------------------------------------------------------------------------------
    public static function get_database_install_sql() {
        $php_to_db = \Kwerqy\Ember\com\db\coder\php_to_db::make();
        return $php_to_db->get_install_sql();
    }
	//--------------------------------------------------------------------------------
    public static function build_db_classes_fromdb() {
        $php_to_db = \Kwerqy\Ember\com\db\coder\db_to_php::make();
        $php_to_db->run();
    }
	//--------------------------------------------------------------------------------
    public static function get_alter_sql() {

    }
	//--------------------------------------------------------------------------------
    public static function is_enabled() {

        if(!getenv("database.default.hostname")) return false;
        if(!getenv("database.default.database")) return false;
        if(!getenv("database.default.username")) return false;
        if(!getenv("database.default.password")) return false;
        if(!getenv("database.default.DBDriver")) return false;

        return true;
    }
	//--------------------------------------------------------------------------------
}