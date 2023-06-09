<?php

namespace Kwerqy\Ember\com\db\coder;

/**
 * @package mod\debug
 * @author Ryno Van Zyl
 */
class php_to_db extends \CodeIgniter\Database\Forge {


    private $sql_arr = [];

	//--------------------------------------------------------------------------------
	public function get_table_arr() {
	    $file_arr = glob(DIR_APP."/db/*");
	    $return_arr = [];

	    foreach ($file_arr as $db_file){
	        $filename = basename($db_file);
	        $return_arr[] = str_replace(["db.", ".php"], "", $filename);
        }
        return $return_arr;
    }
	//--------------------------------------------------------------------------------
	public function get_install_sql($options = []) {
	    $table_arr = $this->get_table_arr();

	    foreach ($table_arr as $table){
	        if(!isset($this->sql_arr[$table])){
                $this->__get_table_install_sql($table);
            }
        }

	    return implode("\n\n", $this->sql_arr);

    }
	//--------------------------------------------------------------------------------
    public function __get_table_install_sql($table){

	    if(array_key_exists($table, $this->sql_arr)) return;

	    $dbt = \core::dbt($table);
        $reference_arr = $dbt->get_reference_arr();

        if($reference_arr){
            foreach ($reference_arr as $reference_table){

                if($reference_table == $table) continue;

                if(!array_key_exists($reference_table, $this->sql_arr)){
                    $this->__get_table_install_sql($reference_table);
                }
            }
        }

        if(!array_key_exists($table, $this->sql_arr)){
            $this->sql_arr[$table] = implode("\n", [
                "-- {$table}",
                $this->get_create_sql($table).";",
            ]);
        }

    }
	//--------------------------------------------------------------------------------
	public function get_create_sql($name, $options = []) {

	    $options = array_merge([
	        "if_not_exists" => true,
	        "attributes" => [],
	    ], $options);

	    $this->reset();

	    $coder = \Kwerqy\Ember\com\db\coder\coder::make();
	    $coder->load_db_class($name);

	    $field_arr = [];
	    $reference_field_arr = [];
	    foreach ($coder->get_field_arr() as $field_data){

	        $data_arr = [];
	        $data_arr['type'] = $coder->get_field_type($field_data["type"]);
	        $data_arr['constraint'] = $coder->get_field_constraint($field_data["type"]);

	        $data_arr['unsigned'] = false;
	        if(\Kwerqy\Ember\isnull($field_data["default"])) $data_arr["null"] = true;
	        else $data_arr['default'] = $field_data["default"];

	        //is key
	        if($field_data["name"] == $coder->get_key()) {
	            $this->addKey($field_data["name"], true, true);
	            $data_arr['auto_increment'] = true;
            }

	        //is reference
            if($field_data["reference"]){
                $dbt_reference = \core::dbt($field_data["reference"]);
                $reference_field_arr[] = [
                    "name" => $field_data["name"],
                    "reference" => $field_data["reference"],
                    "key" => $dbt_reference->key,
                ];
            }


	        $field_arr[$field_data["name"]] = $data_arr;
        }

	    $this->addField($field_arr);

	    foreach ($reference_field_arr as $reference_field){
            $this->addForeignKey($reference_field["name"], $reference_field["reference"], $reference_field["key"]);
        }

	    return $this->_createTable($coder->get_name(), $options["if_not_exists"], $options["attributes"]);
	}
	//--------------------------------------------------------------------------------
	public static function make($options = []) {

	    $options = array_merge([
	        "group" => null
	    ], $options);

	    $db = \CodeIgniter\Database\Config::connect($options["group"]);
		return new static($db);
	}
	//--------------------------------------------------------------------------------
}