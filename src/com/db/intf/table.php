<?php

namespace Kwerqy\Ember\com\db\intf;

/**
 * @package mod\debug
 * @author Ryno Van Zyl
 */
abstract class table {

	protected \CodeIgniter\Database\BaseConnection $connection;

	public int $id;
	public string $key = "";
	public string $name = "";
	public string $display = "";
	public string $display_name = "";
	public string $string = "";
	public string $slug = "";

	/**
	 * FIELDNAME => DISPLAY[0] DEFAULT[1] TYPE[2] REFERENCE[3]
	 * @var array
	 */
	public array $field_arr = [];

	//db row
	protected $obj;

	//db row
	protected $obj_current;

	//--------------------------------------------------------------------------------
	public function __construct() {
		$this->connection = \Kwerqy\Ember\com\connection\connection::get_connection();
	}
	//--------------------------------------------------------------------------------
	private function apply_result_arr(&$result_arr, $options = []){

	    $options = array_merge([
	        "multiple" => false,
	        "source" => "new",
	    ], $options);

		if($options["multiple"]){
			$return = [];
			foreach ($result_arr as $key => $result_data){
				$obj = $this->init_row($result_data, $options);
				$return[$obj->id] = $obj;
			}
			return $this->obj = $return;
		}else{
			if(!$result_arr) return false;
			return $this->obj = $this->init_row($result_arr, $options);
		}
	}
	//--------------------------------------------------------------------------------
    public function get_fromid($id) {
	    $id = \Kwerqy\Ember\data::parse($id, TYPE_INT);

	    if($id) return $this->get_fromdb($id);
    }
	//--------------------------------------------------------------------------------
    public function merge_withrequest($obj, $options = []) {

	    $options = array_merge([
	        "overwrite" => false
	    ], $options);

	    foreach ($this->field_arr as $field => $field_data){

	        if($field == $this->key) continue;

	        $value = \Kwerqy\Ember\Ember::$request->get($field, $field_data[2], [
	            "default" => $field_data[1],
            ]);

	        if($value !== $field_data[1]){
	            if($options["overwrite"] || $field_data[2] == TYPE_BOOL) $obj->{$field} = $value;
	            else if ($obj->is_empty($field) && $field_data[1] != $value) $obj->{$field} = $value;
            }
        }
    }
	//--------------------------------------------------------------------------------
    /**
     * @param $slug
     * @param array $options
     * @return array|\Kwerqy\Ember\com\db\row|\Kwerqy\Ember\com\db\intf\table
     * @throws \Exception
     */
    public function get_fromslug($slug, $options = []) {

	    $options = array_merge([
	        ".{$this->slug}" => $slug
	    ], $options);

	    return $this->find($options);
    }
	//--------------------------------------------------------------------------------
    public function get_fromarray($array) {
		// init
		$obj = $this->get_fromdefault();
		$obj->source = "array";

		if(isset($array[$this->key])) $obj->id = $array[$this->key];

		// build object from array
		foreach ($this->field_arr as $field_index => $field_item) {
			if (isset($array[$field_index])) $obj->{$field_index} = $array[$field_index];
		}

		// end
		return $obj;
	}
	//--------------------------------------------------------------------------------

	/**
	 * @param $mixed
	 * @param array $options
	 * @return array|\Kwerqy\Ember\com\db\row|\Kwerqy\Ember\com\db\intf\table|\Kwerqy\Ember\com\db\row[]|\Kwerqy\Ember\com\db\intf\table[]
	 */
	public function get_fromdb($mixed, $options = []) {

		$options = array_merge([
		    "multiple" => false,
		], $options);

		//sql
		$sql = \Kwerqy\Ember\com\db\sql\select::make();
		$sql->select("{$this->name}.*");
		$sql->from($this->name);

		if(is_int($mixed)){
			$sql->and_where("{$this->key} = ".dbvalue($mixed));
		}else if(is_string($mixed)){
			$sql->and_where($mixed);
		}
		//limit
		if(!$options["multiple"]) $sql->limit(1);

		$result_arr = $sql->run();

		if($result_arr) $options["source"] = "database";

		return $this->apply_result_arr($result_arr, $options);

	}
	//--------------------------------------------------------------------------------
    /**
     * @param $value
     * @param array $options
     * @return array|false|table|table[]|\Kwerqy\Ember\com\db\row|\Kwerqy\Ember\com\db\row[]|\Kwerqy\Ember\com\intf\standard
     */
    public function get_fromstring($value, $options = []) {
        return $this->get_fromdb("{$this->string} = ".\Kwerqy\Ember\dbvalue($value));
    }
	//--------------------------------------------------------------------------------
    /**
     * @param array $options
     * @return array|false|table|table[]|\Kwerqy\Ember\com\db\row|\Kwerqy\Ember\com\db\row[]|\Kwerqy\Ember\com\intf\standard
     */
    public function get_fromrequest($options = []) {

    	$options = array_merge([
    	    "overwrite" => false
    	], $options);

    	$obj = $this->get_fromdefault();

    	foreach ($this->field_arr as $field => $field_data){
    		$value = \Kwerqy\Ember\Ember::$request->get($field, $field_data[2], $options);
    		if(!\Kwerqy\Ember\isempty($value)) $obj->{$field} = $value;
		}

    	if($obj->is_empty($this->key)){
    		$id = \Kwerqy\Ember\Ember::$request->get("id");
    		if(!\Kwerqy\Ember\isempty($id)) $obj->{$this->key} = $id;
		}

    	if(!$options["overwrite"]){
			foreach ($this->field_arr as $field => $field_data){
				if($obj->is_empty($field)) unset($obj->{$field});
			}
		}

        return $obj;
    }
	//--------------------------------------------------------------------------------
    public function format_name($obj, $options = []) : string {
        $options = array_merge([
            "field_arr" => ["name"],
            "separator" => " ",
        ], $options);

        $name_arr = [];
        foreach ($options["field_arr"] as $field){
            $name_arr[] = $obj->{$field};
        }

        return str_replace("''", "'", implode($options["separator"], $name_arr));
    }
	//--------------------------------------------------------------------------------

	/**
	 * @param $sql \Kwerqy\Ember\com\db\sql\select
	 * @param array $options
	 * @return array|\Kwerqy\Ember\com\db\row|\Kwerqy\Ember\com\intf\standard
	 */
	public function get_fromsql(&$sql, $options = []) {

		$options = array_merge([
		    "multiple" => false,
		], $options);

		//limit
		if(!$options["multiple"]) $sql->limit(1);

		$result_arr = $sql->run();

		if($result_arr) $options["source"] = "database";

		return $this->apply_result_arr($result_arr, $options);

	}

	//--------------------------------------------------------------------------------
	public function get_fromobj($obj) {
		// params
		$new_obj = \Kwerqy\Ember\com\db\row::make($this, "object");

		// add relevant fields found in object
		foreach ($this->field_arr as $field_index => $field_item) {
			if (isset($obj->{$field_index})) {
				$new_obj->{$field_index} = $obj->{$field_index};
			}
		}

		// return object
		return $new_obj;
	}

	//--------------------------------------------------------------------------------
	public function splat($mixed) {
		// from object \com\db\row
		if ($mixed instanceof \Kwerqy\Ember\com\db\row) return $mixed;

		// check if null
		if (\Kwerqy\Ember\isnull($mixed)) return false;

		// from database id
		if (is_numeric($mixed)) return $this->get_fromdb($mixed);

		// from array
		if (is_array($mixed)) return $this->get_fromarray($mixed);

		// from string field specified by string property
		if ($this->string && is_string($mixed)) return $this->get_fromstring($mixed);

		// all other types
		return false;
	}

	//--------------------------------------------------------------------------------
	public function splatid($mixed) {
		$obj = $this->splat($mixed);
		return $obj ? $obj->id : false;
	}
	//--------------------------------------------------------------------------------

	/**
	 * @param array $options
	 * @return array|\Kwerqy\Ember\com\db\row|\Kwerqy\Ember\com\intf\standard
	 * @throws \Exception
	 */
	public function find($options = []) {

		$options = array_merge([
		    "create" => false,
		    "multiple" => false,
		], $options);

		if($options["create"] && $options["multiple"])
		    throw new \Exception("Unsupported: Multiple and Create cant both be true");

		$where_arr = \Kwerqy\Ember\com\arr\arr::extract_signature_items(".", $options);

		$sql = \Kwerqy\Ember\com\db\sql\select::make();
		$sql->select("{$this->name}.*");
		$sql->from($this->name);

		foreach ($where_arr as $field => $value){
			if(is_null($value)){
				$sql->and_where("{$field} IS NULL");
			}else{
				if(substr($value, 0, 1) == "!"){
					$v = substr($value, 1, strlen($value));
					if($v == "null" || is_null($v)){
						$sql->and_where("{$field} IS NOT NULL");
					}else{
						$sql->and_where("{$field} <> ".dbvalue($v));
					}
				}else{
					$sql->and_where("{$field} = ".dbvalue($value));
				}
			}
		}

		$result = $this->get_fromsql($sql, $options);

		if(!$result && !$options["multiple"] && $options["create"]){
			$result = $this->get_fromdefault();

			foreach ($where_arr as $field => $value){
				if(substr($value, 0, 1) != "!"){
					$result->{$field} = $value;
				}
			}
		}elseif(!$result && $options["multiple"]){
			return [];
		}

		return $result;

	}
	//--------------------------------------------------------------------------------
	/**
	 * @param array $options
	 * @return \Kwerqy\Ember\com\db\row|\Kwerqy\Ember\com\intf\standard
	 */
	public function get_fromdefault($options = []) {

		//init defaults
		return $this->init_row();

	}

	//--------------------------------------------------------------------------------
    public function on_insert(&$obj) {}
    public function on_insert_complete(&$obj) {}
    public function on_update(&$obj, &$obj_current) {}
    public function on_update_complete(&$obj, &$obj_current) {}
    public function on_save(&$obj) {}
    public function on_save_complete(&$obj) {}
    public function on_delete(&$obj) {}
    public function on_delete_complete(&$obj) {}
    public function install_defaults($options = []) {}
	//--------------------------------------------------------------------------------
    public function save($obj, $options = []) {
        if(!isset($obj->{$this->key}) || \Kwerqy\Ember\isempty($obj->{$this->key})){
            return $this->insert($obj, $options);
        }else{
            return $this->update($obj, $options);
        }
    }
	//--------------------------------------------------------------------------------
    /**
     * @param $obj
     * @param array $options
     * @return mixed
     * @throws \Exception
     */
	public function update($obj, $options = []) {

		if(!$obj->id)
			throw new \Exception("Cannot update db entry without a primary id");

		//apply the slug
	    if($this->slug && $this->is_empty($obj, $this->slug))
	        $obj->{$this->slug} = $this->build_slug();

	    //on update
	    $this->on_update($obj, $this->obj_current);

		//sql
		$builder = $this->connection->table($this->name);
		$builder->where("{$this->key} = ".dbvalue($obj->id));

		$field_arr = $obj->get_array();
		foreach ($field_arr as $field => $value){
			if(\Kwerqy\Ember\isnull($value)) $value = null;
			$builder->set($field, $value, true);
		}
		$builder->update();

		//on update complete
	    $this->on_update_complete($obj, $this->obj_current);

		return $obj;

	}
	//--------------------------------------------------------------------------------
    public function delete($obj, $force = false) {
    	// audit
		$obj = $this->splat($obj);

		// no primary key
		if (!isset($obj->id)) return false;

		// call events and break when bool(false) is returned
		$result = $this->on_delete($obj);
		if ($result === false) return false;

		// validate delete
		if (!is_object($obj)) \com\error::create("Not an object");

		if ($obj) {

			$builder = $this->connection->table($this->name);
			$success = $builder->delete("$this->key = '$obj->id'");

			return $success;
		}
		return false;
    }
	//--------------------------------------------------------------------------------
    public function get_prefix() : string {
        return substr($this->key, 0, 3);
    }
	//--------------------------------------------------------------------------------
    public function insert($obj, $options = []) {

	    //apply the slug
	    if($this->slug)
	        $obj->{$this->slug} = $this->build_slug();

	    //on insert
	    $this->on_insert($obj);

		//sql
		$builder = $this->connection->table($this->name);
		$field_arr = $obj->get_array(["filter_empty" => true]);

		$builder->insert($field_arr);

		$obj->{$this->key} = $obj->id = $this->connection->insertID();

		//on insert
	    $this->on_insert_complete($obj);

		return $obj;
    }
	//--------------------------------------------------------------------------------
	public function is_empty($obj, $field, $options = []) {

		$default = $this->field_arr[$field][1];

		if($obj && property_exists($obj, $field)){
			return $obj->{$field} == $default;
		}

		return true;

	}
	//--------------------------------------------------------------------------------
	public function get_array($obj, $options = []) {

		$options = array_merge([
		    "filter_empty" => false
		], $options);

		//init defaults
		$return_arr = [];

		if(!$obj) return $return_arr;

		foreach ($this->field_arr as $field => $field_options){
			if($obj && property_exists($obj, $field)){
				if($options["filter_empty"]){
					if(!$obj->is_empty($field))
						$return_arr[$field] = $obj->{$field};
				}else{
					$return_arr[$field] = $obj->{$field};
				}
			}else if(!$options["filter_empty"]){
				$return_arr[$field] = $field_options[1];
			}
		}

		return $return_arr;
	}
	//--------------------------------------------------------------------------------

    /**
     * @param array $arr
     * @param array $options
     * @return \Kwerqy\Ember\com\db\row|\Kwerqy\Ember\com\intf\standard|\Kwerqy\Ember\com\db\row
     */
	private function init_row($arr = [], $options = []) {

	    $options = array_merge([
	        "source" => "new"
	    ], $options);

		$obj = \Kwerqy\Ember\com\db\row::make($this, $options["source"]);

		if(isset($arr[$this->key]))
		    $obj->id = $arr[$this->key];

		//defaults
		foreach ($this->field_arr as $field => $field_options){
			$obj->{$field} = $field_options[1];
		}

		//merge data
		foreach ($arr as $field => $value){
			$obj->{$field} = \Kwerqy\Ember\com\data\data::parse($value, $this->get_field_datatype($field));
		}

		$this->obj_current = $obj;

		return $obj;

	}
	//--------------------------------------------------------------------------------
	public function get_field_datatype($field) {
	    return $this->field_arr[$field][2];
	}
	//--------------------------------------------------------------------------------
	public function get_reference_arr() {

	    $reference_arr = array_column($this->field_arr, 3);

		return array_column($this->field_arr, 3);
	}
	//--------------------------------------------------------------------------------
    public function get_last_inserted_id() {

        $sql = \Kwerqy\Ember\com\db\sql\select::make();
        $sql->select($this->key);
        $sql->from($this->name);
        $sql->orderby($this->key, "DESC");

        $id = \core::db()->selectsingle($sql->build());
        
        if($id && !\Kwerqy\Ember\isnull($id)) return $id;
        return 0;

    }
	//--------------------------------------------------------------------------------
    public function build_slug(): string {

	    if(!$this->slug) return "";

        $slug_parts = [];
        $slug_parts[] = $this->get_prefix();
        $slug_parts[] = $this->get_last_inserted_id();
        $slug_parts[] = $this->obj_current->{$this->display};

        return implode("-", $slug_parts);

    }
	//--------------------------------------------------------------------------------
    public function get_alter_sql($options = []): string {

	    return \Kwerqy\Ember\com\db\coder\php_to_db::make()->get_alter_sql($this->name, $options);
    }
	//--------------------------------------------------------------------------------
    public function get_create_sql($options = []): string {

	    return \Kwerqy\Ember\com\db\coder\php_to_db::make()->get_create_sql($this->name, $options);
    }
    //--------------------------------------------------------------------------------
    public function sanitize_field_arr(&$obj, $options = []) {

        foreach ($obj->db->field_arr as $name => $data){
    		if(in_array($data[2], [DB_TEXT, DB_STRING, DB_HTML]) && !$obj->is_empty($name)){
    			$obj->{$name} = $this->sanitize_value($obj->{$name});
			}
		}
    }
    //--------------------------------------------------------------------------------
    public function sanitize_value($str, $options = []) {

        return  str_replace("’", "'", $str);

    }
    //--------------------------------------------------------------------------------
    public function encode_field_arr(&$obj, $options = []) {

        foreach ($this->field_arr as $name => $data){
    		if(in_array($data[2], [TYPE_TEXT, TYPE_VARCHAR, TYPE_HTML]) && !$obj->is_empty($name)){
    			$obj->{$name} = \Kwerqy\Ember\dbvalue(htmlentities($obj->{$name}), false);
			}
		}
    }
    //--------------------------------------------------------------------------------
    public function decode_field_arr(&$obj, $options = []) {

        foreach ($obj->db->field_arr as $name => $data){
    		if(in_array($data[2], [TYPE_TEXT, TYPE_VARCHAR, TYPE_HTML]) && !$obj->is_empty($name)){
    			$obj->{$name} = str_replace("''", "'", html_entity_decode($obj->{$name}));
			}
		}
    }
	//--------------------------------------------------------------------------------
	public function is_unique($obj) {
		// params
		$obj = $this->splat($obj);

		// sql
		$sql = \Kwerqy\Ember\com\db\sql\select::make();
		$sql->select($this->key);
		$sql->from($this->name);
		$sql->and_where("{$this->display} = ".dbvalue($obj->{$this->display}));

		// existing product
		if (!$obj->is_empty($this->key)) $sql->and_where("{$this->key} <> '$obj->id'");

		// check for unique username
		return !(bool)\core::db()->selectsingle($sql->build());
	}
    //--------------------------------------------------------------------------------
    public function decode_obj(&$obj, $options = []) {

		if (isset($options["multiple"])) {
			foreach ($obj as $d) $this->decode_field_arr($d);
		} else if ($obj) {
			$this->decode_field_arr($obj);
		}

    }
    //--------------------------------------------------------------------------------
    public function encode_obj(&$obj, $options = []) {
        $this->encode_field_arr($obj, $options);
    }
    //--------------------------------------------------------------------------------
    public function enum_arr($obj, $field, $unset_index = true, $options = []) {

    	$arr = $this->{$field};

    	if(is_array($unset_index)){
    		foreach ($unset_index as $key) unset($arr[$key]);
		}else if($unset_index === true){
    		\Kwerqy\Ember\com\arr\arr::unset_first_index($arr);
		}

    	return $arr;
    }
    //--------------------------------------------------------------------------------
    public function get_next_id() {

        $sql = \Kwerqy\Ember\com\db\sql\select::make();
        $sql->select("AUTO_INCREMENT");
        $sql->from("information_schema.TABLES");
        $sql->and_where("TABLE_SCHEMA = '".\core::$app->get_instance()->get_db_name()."'");
        $sql->and_where("TABLE_NAME = '$this->name'");

        return intval(\core::db()->selectsingle($sql->build()));
    }
    //--------------------------------------------------------------------------------
    public function get_slug($obj, $options = []) {

    	if(!property_exists($this, "slug")) return false;

        return $obj->{$this->slug};
    }
    //--------------------------------------------------------------------------------
    public function get_slug_name($obj, $options = []) {

    	if(!property_exists($this, "slug")) return false;

        return $obj->{$this->slug};
    }
    //--------------------------------------------------------------------------------
    public function get_seo_name($obj, $options = []) {
        return $this->get_slug_name($obj);
    }
    //--------------------------------------------------------------------------------
    public function get_fromseo($options = []) {
        return $this->get_fromslug($options);
    }
    //--------------------------------------------------------------------------------

    /**
     * Select a single field
     * @param $field
     * @param $where
     * @return bool|string
     */
    public function selectsingle($mixed, $field = false) {

        // params
        if (!$field) $field = $this->display;

        $sql = \Kwerqy\Ember\com\db\sql\select::make();
        $sql->select($field);
        $sql->from($this->name);

        if (is_numeric($mixed)) {
            $sql->and_where("$this->key = '$mixed'");
        } else {
            $sql->and_where($mixed);
        }

        $value = \core::db($this->database)->selectsingle($sql->build());

        // with new sql driver 4.3.0+ -- hex2bin is done automatically
        if (!\core::$instance->get_option("com.db.disable_hex2bin")) {
            // conversions based on field
            switch ($this->field_arr[$field][2]) {
                case DB_BINARY :
                    if (!isnull($value)) $value = hex2bin($value);
                    break;
            }
        }

        // done
        return $value;
    }
    //--------------------------------------------------------------------------------
	/**
	 * @param $obj
	 * @param array $field_arr
	 * @param array $options
	 * @return \com\db\row|\com\db\row[]|\com\db\table|\com\db\table[]|false
	 * @throws \Exception
	 */
    public function decrypt_fields(&$obj, $field_arr = [], $options = []) {

    	if(!$field_arr) return $obj;

    	$fn_decrypt = function(&$obj) use (&$field_arr){
    		if($obj){
				foreach ($field_arr as $field){
					if(!$obj->is_empty($field)) $obj->{$field} = \Kwerqy\Ember\com\str\str::decrypt_r($obj->{$field});
				}
			}
		};

		if(isset($options["multiple"])){
			foreach ($obj as $key => $o) $fn_decrypt($o);
		}else{
			$fn_decrypt($obj);
		}

		return $obj;

    }
    //--------------------------------------------------------------------------------
	/**
	 * @param $obj
	 * @param array $field_arr
	 * @param array $options
	 * @return mixed
	 * @throws \Exception
	 */
    public function encrypt_fields(&$obj, $field_arr = [], $options = []) {

    	if(!$field_arr) return $obj;

    	$fn_decrypt = function(&$obj) use (&$field_arr){
    		foreach ($field_arr as $field){
				if(!$obj->is_empty($field)) $obj->{$field} = \Kwerqy\Ember\com\str\str::encrypt_r($obj->{$field});
			}
		};

		$fn_decrypt($obj);

		return $obj;

    }
    //--------------------------------------------------------------------------------
	/**
	 * @param $obj
	 * @param $field
	 * @param $where
	 * @param array $options
	 * @return array|false|mixed
	 */
	public function get_fromdb_json($field, $where, $options = []) {

		$options = array_merge([
		    "orderby" => "{$this->key} DESC"
		], $options);

		$where_arr = \com\arr::splat($where);

		$sql = \Kwerqy\Ember\com\db\sql\select::make();
		$sql->select("{$this->name}.*");
		$sql->from($this->name);
		foreach ($where_arr as $key => $value){
			$sql->json_and_where($field, $key, $value);
		}

		$sql->extract_options($options);

		if($options["orderby"]) $sql->orderby($options["orderby"]);

		return \Kwerqy\Ember\Ember::dbt($this->name)->get_fromsql($sql->build(), $options);
	}
	//--------------------------------------------------------------------------
    public function select_list($options = []) {

        $options = array_merge([
            "field1" => $this->key,
            "field2" => $this->display,
            "orderby" => "field2 DESC",
        ], $options);

        $sql = \Kwerqy\Ember\com\db\sql\select::make();
        $sql->select("{$options["field1"]} AS field1");
        $sql->select("{$options["field2"]} AS field2");

        $sql->from($this->name);

        $sql->extract_options($options);

        return \core::db()->selectlist($sql->build(), "field1", "field2");
    }
    //--------------------------------------------------------------------------------
    public function get_next_order($options = []) {

	    if(!isset($this->field_arr["{$this->key}_order"]))
	        return 0;

        $sql = \Kwerqy\Ember\com\db\sql\select::make();
        $sql->select("MAX({$this->key}_order)");
        $sql->from($this->name);
        $sql->extract_options($options);

        return \core::db()->selectsingle($sql->build());

    }

	//--------------------------------------------------------------------------------
}