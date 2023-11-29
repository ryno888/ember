<?php

namespace Kwerqy\Ember\com\db\sql;

/**
 * Class.
 *
 * @author Liquid Edge Solutions
 * @copyright Copyright Kwerqy. All rights reserved.
 */
class select extends \Kwerqy\Ember\com\db\intf\sql {

	/**
	 * @var \CodeIgniter\Database\BaseConnection
	 */
	protected $connection;

	/**
	 * @var \CodeIgniter\Database\BaseBuilder
	 */
	protected $builder;
	protected $init_table = false;

	/**
	 * @var array
	 */
	private $distinct = false;

	private $select_arr = [];
	private $from_arr = [];
	private $from_subquery_arr = [];
	private $str_join_arr = [];
	private $where_arr = [];
	private $groupby_arr = [];
	private $orderby_arr = [];

	private $limit = 0;
	private $offset = 0;
	//--------------------------------------------------------------------------------

	public function __construct() {

		$this->connection = \Kwerqy\Ember\com\connection\connection::get_connection();

	}
	//--------------------------------------------------------------------------------
	/**
	 * @return \CodeIgniter\Database\BaseConnection
	 */
	public function get_connection(): \CodeIgniter\Database\BaseConnection {
		return $this->connection;
	}
	//--------------------------------------------------------------------------------
	/**
	 * @param $table
	 * @return $this
	 */
	public function from($table) {

		if(substr($table, 0, 9) === "LEFT JOIN" || substr($table, 0, 4) === "JOIN"){
			$this->str_join($table);
		}else{
			if(!$this->init_table) $this->init_table = $table;
			else {
				$this->from_arr[] = [
					"type" => "FROM",
					"sql" => $table,
				];
			}
		}


		return $this;
	}
	//--------------------------------------------------------------------------------
	/**
	 * @return \CodeIgniter\Database\BaseBuilder
	 */
	public function get_builder() {

		$this->create_builder();

		return $this->builder;
	}
	//--------------------------------------------------------------------------------
    public function clear_select() {
        $this->select_arr = [];
    }
	//--------------------------------------------------------------------------------
    public function clear_limit() {
        $this->limit = 0;
    }
	//--------------------------------------------------------------------------------
    public function clear_offset() {
        $this->offset = 0;
    }
	//--------------------------------------------------------------------------------
	/**
	 * @param $sql
	 * @return $this
	 */
	public function select($sql) {

		$this->select_arr[] = [
		    "type" => "SELECT",
		    "sql" => $sql,
        ];

		return $this;
	}
	//--------------------------------------------------------------------------------

    /**
     * @param $field
     * @param bool $alias
     * @return $this
     */
	public function select_max($field, $alias = false) {

	    $this->select_method("MAX", $field, $alias);

		return $this;
	}
	//--------------------------------------------------------------------------------

    /**
     * @param $method
     * @param $field
     * @param false $alias
     * @return $this
     */
	public function select_method($method, $field, $alias = false) {

	    $this->select_arr[] = [
		    "type" => $method,
		    "field" => $field,
		    "alias" => $alias,
        ];

		return $this;
	}
	//--------------------------------------------------------------------------------

    /**
     * @param $field
     * @param false $alias
     * @return $this
     */
	public function select_min($field, $alias = false) {

		return $this->select_method("MIN", $field, $alias);

	}
	//--------------------------------------------------------------------------------

    /**
     * @param $field
     * @param false $alias
     * @return $this
     */
	public function select_avg($field, $alias = false) {

		return $this->select_method("AVG", $field, $alias);
	}
	//--------------------------------------------------------------------------------

    /**
     * @param $field
     * @param false $alias
     * @return $this
     */
	public function select_sum($field, $alias = false) {

		return $this->select_method("SUM", $field, $alias);
	}
	//--------------------------------------------------------------------------------

    /**
     * @param $field
     * @param false $alias
     * @return $this
     */
	public function select_count($field, $alias = false) {

		return $this->select_method("COUNT", $field, $alias);
	}
	//--------------------------------------------------------------------------------

	/**
	 * @param $table
	 * @param $on
	 * @param false $left_join
	 * @return $this
	 */
	public function join($table, $on, $left_join = false) {

	    $this->from_arr[] = [
	        "type" => "JOIN",
	        "sql" => $table,
	        "on" => $on,
	        "left_join" => $left_join,
        ];

//		$this->builder->join($table, $on, !$left_join?:'left');

		return $this;
	}
	//--------------------------------------------------------------------------------

	/**
	 * @param $fn
	 * @return $this
	 */
	public function fn_join($fn) {

		$this->str_join_arr[] = $fn();

		return $this;
	}
	//--------------------------------------------------------------------------------

	/**
	 * @param $sql
	 * @return $this
	 */
	public function str_join($sql) {

		$this->str_join_arr[] = $sql;

		return $this;
	}
	//--------------------------------------------------------------------------------

    /**
     * @param $table
     * @param $on
     * @return $this
     */
	public function left_join($table, $on) {
		return $this->join($table, $on, true);
	}
	//--------------------------------------------------------------------------------

	/**
	 * @param $where
	 * @return $this
	 */
	public function and_where($where, $fn_subquery = null) {

		if($fn_subquery){

			$mixed = $fn_subquery(\Kwerqy\Ember\com\db\sql\select::make());
			if($mixed instanceof \Kwerqy\Ember\com\db\sql\select) $mixed = $mixed->build();

			$where = "$where (\n\t".str_replace("\n", "\n\t", $mixed)."\n)";
		}

		$this->where_arr[] = [
            "type" => "AND_WHERE",
            "sql" => $where,
        ];

//		$this->builder->where($where);

		return $this;
	}
	//--------------------------------------------------------------------------------
    /**
     * @param $field
     * @param null $operator
     * @param null $value
     * @return $this
     */
	public function or_where($field, $operator = null, $value = null) {

	    $this->where_arr[] = [
            "type" => "OR_WHERE",
            "field" => $field,
            "operator" => $operator,
            "value" => $value,
        ];

//		$this->builder->orWhere("{$field} {$operator}", $value);
		return $this;
	}
	//--------------------------------------------------------------------------------

    /**
     * @param $field
     * @param array $in_arr
     * @param false $not
     * @return $this
     */
	public function where_in($field, $in_arr = [], $not = false) {

	    $this->where_arr[] = [
            "type" => "IN_WHERE",
            "field" => $field,
            "values" => is_callable($in_arr) ? $in_arr() : \Kwerqy\Ember\arr::splat($in_arr),
            "not" => $not ? " NOT " : "",
        ];

		return $this;
	}
	//--------------------------------------------------------------------------------

    /**
     * @param $field
     * @param array $search_arr
     * @param false $not
     * @return $this
     */
	public function or_where_in($field, $search_arr = [], $not = false) {

	    $this->where_arr[] = [
            "type" => "OR_IN_WHERE",
            "field" => $field,
            "operator" => is_callable($search_arr) ? $search_arr() : \Kwerqy\Ember\arr::splat($search_arr),
            "not" => $not ? " NOT " : "",
        ];

		return $this;
	}
	//--------------------------------------------------------------------------------

    /**
     * @param $field
     * @param $match
     * @param false $not
     * @return $this
     */
	public function like($field, $match, $not = false) {

	    $this->where_arr[] = [
            "type" => "LIKE",
            "field" => $field,
            "match" => $match,
            "not" => $not ? " NOT " : "",
        ];

		return $this;
	}
	//--------------------------------------------------------------------------------

    /**
     * @param $field
     * @param array $search_arr
     * @param false $not
     * @return $this
     */
	public function or_like($field, $search_arr = [], $not = false) {

		$search_arr = \Kwerqy\Ember\arr::splat($search_arr);

		if (!$search_arr) return $this;

		$this->where_arr[] = [
            "type" => "OR_LIKE",
            "field" => $field,
            "search_arr" => $search_arr,
            "not" => $not ? " NOT " : "",
        ];

		return $this;
	}
	//--------------------------------------------------------------------------------

    /**
     * @param $field
     * @return $this
     */
	public function groupby($field) {
	    $this->groupby_arr[] = $field;

	    return $this;
	}
	//--------------------------------------------------------------------------------

    /**
     * @param $key
     * @param null $value
     * @return $this
     */
	public function having($key, $value = null) {

	    $this->where_arr[] = [
            "type" => "HAVING",
            "key" => $key,
            "value" => $value,
        ];

	    return $this;

//		$this->builder->having($key, $value);
	}
	//--------------------------------------------------------------------------------

    /**
     * @param $key
     * @param null $value
     * @return $this
     */
	public function or_having($key, $value = null) {

	    $this->where_arr[] = [
            "type" => "OR_HAVING",
            "key" => $key,
            "value" => $value,
        ];

	    return $this;
//		$this->builder->orHaving($key, $value);
	}
	//--------------------------------------------------------------------------------

    /**
     * @return $this
     */
	public function distinct() {
		$this->distinct = true;

		return $this;
	}
	//--------------------------------------------------------------------------------
    /**
     * @param $field
     * @param $sort
     * @return $this
     */
	public function orderby($field, $sort = false) {

		
		if($sort){
			$this->orderby_arr[] = [
				"field" => $field,
				"sort" => $sort,
			];
		}else{
			$orderby_arr = explode(",", $field);
			foreach ($orderby_arr as $orderby){
				$orderby_parts = explode(" ", trim($orderby));
				$this->orderby_arr[] = [
					"field" => $orderby_parts[0],
					"sort" => $orderby_parts[1],
				];
			}
		}

	    return $this;

//		$this->builder->orderBy($field, $sort);
	}
	//--------------------------------------------------------------------------------

    /**
     * @param $value
     * @return $this
     */
	public function limit($value) {

		$this->limit = abs($value);

		return $this;
//		$this->builder->limit($value, $offset);
	}
	//--------------------------------------------------------------------------------

    /**
     * @param $value
     * @return $this
     */
	public function offset($value) {

		$this->offset = $value;

		return $this;
//		$this->builder->limit($value, $offset);
	}
	//--------------------------------------------------------------------------------
	public function run() {

		$sql = $this->build();

		$query = $this->connection->query($sql);

		$result_arr = $query->getResultArray();

		if($this->limit == 1){
			return reset($result_arr);
		}

		return $result_arr;
	}
	//--------------------------------------------------------------------------------

	/**
	 * @param $subquery
	 * @param $alias
	 * @return $this
	 */
	public function from_subquery($subquery, $alias) {

		if(is_callable($subquery) && !$subquery instanceof \CodeIgniter\Database\BaseBuilder){
			$subquery = $subquery();
		}

		$this->from_subquery_arr[] = [
	        "subquery" => $subquery,
	        "alias" => $alias,
        ];

		return $this;
	}
	//--------------------------------------------------------------------------------
	private function create_builder() {

		$this->builder = new \Kwerqy\Ember\com\db\base_builder($this->init_table, $this->connection);

//		$this->builder = $this->connection->table($this->init_table);

	    //distinct
        if($this->distinct)
            $this->builder->distinct();

        //select
        foreach ($this->select_arr as $select_data){
            switch ($select_data["type"]){
                case "SELECT": $this->builder->select($select_data["sql"]); break;
                case "MAX": $this->builder->selectMax($select_data["field"], $select_data["alias"]); break;
                case "MIN": $this->builder->selectMin($select_data["field"], $select_data["alias"]); break;
                case "AVG": $this->builder->selectAvg($select_data["field"], $select_data["alias"]); break;
                case "SUM": $this->builder->selectSum($select_data["field"], $select_data["alias"]); break;
                case "COUNT": $this->builder->selectCount($select_data["field"], $select_data["alias"]); break;
            }
        }

        //from
        foreach ($this->from_arr as $from_data){
            switch ($from_data["type"]){
                case "FROM": $this->builder->from($from_data["sql"]); break;
                case "JOIN": $this->builder->join($from_data["sql"], $from_data["on"], !$from_data["left_join"]?:'left'); break;
            }
        }

        foreach ($this->from_subquery_arr as $subquery){
        	$this->builder->fromSubquery($subquery["subquery"], $subquery["alias"]);
		}

        foreach ($this->str_join_arr as $sql){
        	$this->builder->str_join($sql);
		}

        //where
        foreach ($this->where_arr as $where_data){
            switch ($where_data["type"]){
                case "AND_WHERE": $this->builder->where($where_data["sql"]); break;
                case "OR_WHERE": $this->builder->orWhere("{$where_data["field"]} {$where_data["operator"]}", $where_data["value"]); break;
                case "IN_WHERE": $this->builder->whereIn("{$where_data["not"]}{$where_data["field"]}", $where_data["values"]); break;
                case "OR_IN_WHERE": $this->builder->orWhereIn("{$where_data["not"]}{$where_data["field"]}", $where_data["values"]); break;
                case "LIKE": $this->builder->like("{$where_data["not"]}{$where_data["field"]}", $where_data["match"]); break;
                case "OR_LIKE": $this->builder->orLike("{$where_data["not"]}{$where_data["field"]}", $where_data["match"]); break;
                case "HAVING": $this->builder->having($where_data["key"], $where_data["value"]); break;
                case "OR_HAVING": $this->builder->orHaving($where_data["key"], $where_data["value"]); break;
            }
        }

        //group by
        if($this->groupby_arr)
		    $this->builder->groupBy($this->groupby_arr);

        //order by
		foreach ($this->orderby_arr as $orderby){
		    $this->builder->orderBy($orderby["field"], $orderby["sort"]);
		}

		//limit
        if($this->limit)
            $this->builder->limit($this->limit, $this->offset);
	}
	//--------------------------------------------------------------------------------
	public function build() {

	    $this->create_builder();

		return $this->builder->getCompiledSelect(false);

	}
	//--------------------------------------------------------------------------------
	public function json_and_where($field, $key, $value) {
		$this->and_where("{$field} RLIKE '\"{$key}\":\"[[:<:]]{$value}[[:>:]]\"'");
		return $this;
	}
	//--------------------------------------------------------------------------------
	public function json_or_where($field, $key, $value) {
		$this->or_where("{$field} RLIKE '\"{$key}\":\"[[:<:]]{$value}[[:>:]]\"'");
		return $this;
	}
	//--------------------------------------------------------------------------------
    public function is_empty($field) {
        if(property_exists($this, $field)){
            if(!$this->{$field}) return true;
        }
    }
    //--------------------------------------------------------------------------------
	public function left_join_property($key, $parent_table, $alias, $options = []) {
        $options = array_merge([
            "joining_field" => false,
            "inner_where" => false,
            "use_custom_field" => false,
        ], $options);

        $solid = \Kwerqy\Ember\com\solid_classes\solid::get_instance($key);
        $parent_dbt = \Kwerqy\Ember\Ember::dbt($parent_table);
        $property_dbt = \Kwerqy\Ember\Ember::dbt($parent_dbt->get_property_table($parent_dbt));
        $property_prefix = $property_dbt->get_prefix();
		$ref_field = "{$property_prefix}_ref_{$parent_dbt->name}";
		$key_field = "{$property_prefix}_key";

		$sql = self::make();
        $sql->select("*");
        $sql->from("{$property_dbt->name} AS a");
        $sql->fn_join(function() use($solid, $parent_dbt, $property_dbt, $property_prefix, $ref_field, $key_field, $options){
        	$sql = self::make();
			if($options["use_custom_field"]) $sql->select("MAX({$property_prefix}_is_custom) AS max_custom");
			$sql->select("{$key_field} AS inner_key");
			$sql->select("{$ref_field} AS inner_ref");
			$sql->from($property_dbt->name);
			$sql->and_where("{$key_field} = '{$solid->get_key()}'");
			if($options["inner_where"]) $sql->and_where($options["inner_where"]);
			$sql->groupby($ref_field);
			$sql->groupby($key_field);

			$join_arr = [];
			$join_arr[] = "a.{$key_field} = b.inner_key";
			$join_arr[] = "a.{$ref_field} = b.inner_ref";
			$join_arr[] = "inner_key = '{$solid->get_key()}'";
			if($options["use_custom_field"]) $join_arr[] = "a.{$property_prefix}_is_custom = b.max_custom";

        	return "JOIN ({$sql->build()}) AS b ON (".implode(" AND ", $join_arr).") ";
		});
        $this->str_join("LEFT JOIN ( {$sql->build()} ) AS {$alias} ON ({$parent_dbt->name}.{$parent_dbt->key} = {$alias}.{$ref_field})");
	}
    //--------------------------------------------------------------------------------
	public function extract_options($options = []) {

	    $fn_extract = function($key, $fn)use($options){
	        if(isset($options[$key]) && $options[$key]){
                $options[$key] = \Kwerqy\Ember\com\arr\arr::splat($options[$key]);
                foreach ($options[$key] as $from)
                    if($from) $this->{$fn}($from);
            }
        };

	    $fn_extract("from", "from");
	    $fn_extract("sql_where", "and_where");
	    $fn_extract("and_where", "and_where");
	    $fn_extract("where", "and_where");
	    $fn_extract("limit", "limit");
	    $fn_extract("orderby", "orderby");

		// extract the fields from options
		$field_arr = \Kwerqy\Ember\com\arr\arr::extract_signature_items(".", $options);
		if (!$field_arr) return false;

		// generate sql for find query
		foreach ($field_arr as $field_index => $field_item) {
			// handle null
			if (isnull($field_item)) {
				$this->and_where("{$field_index} IS NULL");
			}
			else {
				$value = dbvalue($field_item);
				$this->and_where("{$field_index} = {$value}");
			}
		}
	}
	//--------------------------------------------------------------------------------
}
