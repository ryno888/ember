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
    /**
     * @param $slug
     * @param array $options
     * @return array|false|\Kwerqy\Ember\com\db\row|\Kwerqy\Ember\com\intf\standard
     * @throws \Exception
     */
    public function get_fromslug($slug, $options = []) {

	    $options = array_merge([
	        ".{$this->slug}" => $slug
	    ], $options);

	    return $this->find($options);
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

		$where_arr = \Kwerqy\Ember\arr::extract_signature_items(".", $options);

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
    public function on_insert($obj) {}
    public function on_insert_complete($obj) {}
    public function on_update($obj, $obj_current) {}
    public function on_update_complete($obj, $obj_current) {}
    public function on_save($obj) {}
    public function on_save_complete($obj) {}
    public function on_delete($obj) {}
    public function on_delete_complete($obj) {}
	//--------------------------------------------------------------------------------
    public function save($obj, $options = []) {
        if(isempty($obj->{$this->key})){
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

		$field_arr = $obj->get_array(["filter_empty" => true]);
		foreach ($field_arr as $field => $value){
			$builder->set($field, $value);
		}
		$builder->update();

		//on update complete
	    $this->on_update_complete($obj, $this->obj_current);

		return $obj;

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

		//defaults
		foreach ($this->field_arr as $field => $field_options){
			$obj->{$field} = $field_options[1];
		}

		//merge data
		foreach ($arr as $field => $value){
			$obj->{$field} = $value;
		}

		$this->obj_current = $obj;

		return $obj;

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

        return \core::db()->selectsingle($sql->build());

    }
	//--------------------------------------------------------------------------------
    public function build_slug(): string {

	    if(!$this->slug) return "";

        $slug_parts = [];
        $slug_parts[] = $this->get_prefix();
        $slug_parts[] = md5($this->get_last_inserted_id());

        return implode("-", $slug_parts);

    }
	//--------------------------------------------------------------------------------
////--------------------------------------------------------------------------------
//	public function merge_witharray($arr = []) {
//		foreach ($arr as $field => $value){
//			$this->obj->{$field} = $value;
//		}
//	}
	//--------------------------------------------------------------------------------
}