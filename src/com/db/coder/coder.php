<?php

namespace Kwerqy\Ember\com\db\coder;

/**
 * @package mod\debug
 * @author Ryno Van Zyl
 */
/**
 * @package mod\debug
 * @author Ryno Van Zyl
 */
class coder extends \Kwerqy\Ember\com\intf\standard {

	protected $name;
	protected string $prefix;
	protected string $key;
	protected string $display_field;
	protected string $display_name;
	protected array $field_arr = [];

	//--------------------------------------------------------------------------------
	/**
	 * @param mixed $name
	 */
	public function set_name($name): void {
		$this->name = $name;
	}

	//--------------------------------------------------------------------------------
	/**
	 * @param mixed $key
	 */
	public function set_key($key): void {
		$this->key = $key;
	}

	//--------------------------------------------------------------------------------
	/**
	 * @param mixed $display_name
	 */
	public function set_display_name($display_name): void {
		$this->display_name = $display_name;
	}

	//--------------------------------------------------------------------------------
    /**
     * @return array
     */
    public function get_field_arr(): array {
        return $this->field_arr;
    }
	//--------------------------------------------------------------------------------
	/**
	 * @param mixed $display_field
	 */
	public function set_display_field($display_field): void {
		$this->display_field = $display_field;
	}

	//--------------------------------------------------------------------------------
	/**
	 * @param mixed $prefix
	 */
	public function set_prefix($prefix): void {
		$this->prefix = $prefix;
	}
	//--------------------------------------------------------------------------------

	/**
	 * @param $name
	 * @param $display_name
	 * @param $type
	 * @param $default
	 * @param $reference
	 */
	public function add_field($name, $display_name, $type, $default, $reference): void {
		$this->field_arr[] = [
			"name" => $name,
			"display_name" => $display_name,
			"type" => $type,
			"default" => $default,
			"reference" => $reference,
		];
	}
	//--------------------------------------------------------------------------------
    public function get_field_type($type) {
        return \Kwerqy\Ember\com\data\data::get_class($type)->get_dbvalue();
    }
	//--------------------------------------------------------------------------------
    public function get_field_constraint($type) {
        switch ($type){
            case TYPE_REFERENCE:
            case TYPE_INT:
            case TYPE_KEY: return "11";

            case TYPE_TELNR:
            case TYPE_EMAIL:
            case TYPE_VARCHAR:
            case TYPE_STRING: return "256";

            case TYPE_BOOL:
            case TYPE_TINYINT:
            case TYPE_ENUM: return "4";

            case TYPE_DATETIME:
            case TYPE_TEXT:
            case TYPE_LONGBLOB:
            case TYPE_FILE:
            case TYPE_DATE: return "";
            case TYPE_DOUBLE:
            case TYPE_DECIMAL:
            case TYPE_FLOAT: return "19,5";
        }
    }
	//--------------------------------------------------------------------------------
    /**
     * @return string
     */
    public function get_key(): string {
        return $this->key;
    }
	//--------------------------------------------------------------------------------
    /**
     * @return string
     */
    public function get_display_field(): string {
        return $this->display_field;
    }
	//--------------------------------------------------------------------------------
    /**
     * @return string
     */
    public function get_display_name(): string {
        return $this->display_name;
    }
	//--------------------------------------------------------------------------------
    public function load_db_class($name) {

        $dbt = \Kwerqy\Ember\Ember::dbt($name);
        $this->set_prefix($dbt->get_prefix());
        $this->set_key($dbt->key);
        $this->set_name($name);
        $this->set_display_name(\Kwerqy\Ember\com\str\str::propercase(str_replace("_", " ", $name)));
        $this->set_display_field($dbt->display);

        foreach ($dbt->field_arr as $field_name => $field_data){
            $reference = isset($field_data[3]) ? "{$dbt->get_prefix()}_ref_{$field_data[3]}" : null;
            $this->add_field($field_name, $field_data[0], $field_data[2], $field_data[1], (isset($field_data[3]) ? $field_data[3] : $reference));
        }
    }
	//--------------------------------------------------------------------------------
}