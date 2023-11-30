<?php

namespace Kwerqy\Ember\com\db\tra;

trait property_table {

    /**
     * @var \com\db\sql\select
     */
    private $sql_builder;

    //--------------------------------------------------------------------------------

    /**
     * @param $obj
     * @param array $options
     * @return false|string
     */
    public function get_property_table($obj, $options = []) {

        if(!property_exists($this, "property_table"))
            return false;

        return $this->property_table;
    }
    //--------------------------------------------------------------------------------
    public function load_properties($obj, $options = []) {

        $options = array_merge([
            "force" => false,
        ], $options);


        if(property_exists($obj, "property_arr") && $obj->property_arr && !$options["force"]){
            return $obj->property_arr;
        }else{
            $obj->property_arr = [];
            $property_table = $this->get_property_table($obj);

            if($property_table){
                $property_dbt = \Kwerqy\Ember\Ember::dbt($property_table);
                $field = $property_dbt->get_prefix()."_ref_{$this->name}";

                $sql = \Kwerqy\Ember\com\db\sql\select::make();

                $sql->select("{$property_table}.*");
                $sql->from($property_table);
                $sql->and_where("{$field} = {$obj->{$this->key}}");
                $sql->extract_options($options);

                $obj->property_arr = $property_dbt->get_fromsql($sql, ["multiple" => true]);
            }
        }
    }
    //--------------------------------------------------------------------------------
    public function get_property($obj, $key, $options = []) {

        $options = array_merge([
            "force" => false,
        ], $options);

        $property_arr = $this->get_property_arr($obj, $key, $options);

        return reset($property_arr);

    }
    //--------------------------------------------------------------------------------
    public function has_property($obj, $key, $options = []) {

        $options = array_merge([
            "force" => true,
        ], $options);

        return (bool) $this->get_property($obj, $key, $options);

    }
    //--------------------------------------------------------------------------------
    public function save_property($obj, $key, $value = false, $options = []) {

        $options = array_merge([
            "force" => true,
            "audit" => true,
            "trace" => true,
        ], $options);

        if(\Kwerqy\Ember\isempty($value)) return;

        $property_table = $this->get_property_table($obj);
        $property = $this->get_property($obj, $key, $options);
        $solid = \Kwerqy\Ember\com\solid_classes\solid::get_instance($key);

        if(!$solid) return \app\error::create("Solid class for '$key' was not found");

        if(!$property && $property_table) {
            $property = $property_dbt = \Kwerqy\Ember\Ember::dbt($property_table)->get_fromdefault();
            $property->{$property_dbt->get_prefix()."_ref_{$this->name}"} = $obj->id;
            $property->{$property_dbt->get_prefix()."_key"} = $key;
        }

        $property->{$property->db->get_prefix()."_value"} = $solid->parse($value);
        $field_value_arr = \Kwerqy\Ember\com\arr\arr::extract_signature_items(".", $options);
        foreach ($field_value_arr as $field => $field_value){
            $property->{$field} = $field_value;
        }
        $property->audit = $options["audit"];
        $property->trace = $options["trace"];
        $property->save();

    }
    //--------------------------------------------------------------------------------
	public function save_property_str_to_arr($obj, $key, $value_arr = [], $options = []) {

    	$options = array_merge([
    	    "delete" => true
    	], $options);

    	$property_table = $this->get_property_table($obj);
    	$property_table_dbt = \Kwerqy\Ember\Ember::dbt($property_table);
    	$property_prefix = $property_table_dbt->get_prefix();
    	$reference_field = "{$property_prefix}_ref_{$this->name}";

		foreach ($value_arr as $value){
			$property = \Kwerqy\Ember\Ember::dbt($property_table)->find([
				".{$reference_field}" => $obj->id,
				".{$property_prefix}_key" => $key,
				".{$property_prefix}_value" => $value,
				"create" => true,
			]);
			if($property->source != "database") $property->save();
		}

		if($options["delete"]){
			$sql = \Kwerqy\Ember\com\db\sql\select::make();
			$sql->select("{$property_table}.*");
			$sql->from($property_table);
			$sql->and_where("{$reference_field} = ".dbvalue($obj->id));
			$sql->and_where("{$property_prefix}_key = ".dbvalue($key));
			if($value_arr) $sql->where_in("{$property_prefix}_value", $value_arr, true);
			$delete_property_arr = \Kwerqy\Ember\Ember::dbt($property_table)->get_fromsql($sql, ["multiple" => true]);
			foreach ($delete_property_arr as $delete_property) $delete_property->delete();
		}
	}
    //--------------------------------------------------------------------------------
	/**
	 * @param $obj
	 * @return \app\solid\property_set\intf\standard|mixed
	 */
	public function get_solid_class($obj) {
		return \Kwerqy\Ember\com\solid_classes\solid::get_instance($obj->{$obj->get_prefix()."_key"});
	}
    //--------------------------------------------------------------------------------
    public function get_prop($obj, $key, $options = []) {

        $solid = \Kwerqy\Ember\com\solid_classes\solid::get_instance($key);

        $options = array_merge([
            "force" => false,
            "default" => $solid->get_default(),
            "format" => false,
        ], $options);

        if($obj->is_empty($this->key)) return $options["default"];

        if($options["force"]){
        	$property_table = $this->get_property_table($obj);
			$property_dbt = \Kwerqy\Ember\Ember::dbt($property_table);
			$field = $property_dbt->get_prefix()."_ref_{$this->name}";

			$sql = \Kwerqy\Ember\com\db\sql\select::make();
			$sql->select("{$property_table}.*");
			$sql->from($property_table);
			$sql->and_where("{$field} = {$obj->{$this->key}}");
			$sql->and_where("{$property_dbt->get_prefix()}_key = ".dbvalue($key));
			$sql->extract_options($options);

			$property = $property_dbt->get_fromsql($sql);
			if($property){
				if(!property_exists($obj, "property_arr")) $obj->property_arr = [];
				$obj->property_arr[$property->id] = $property;
			}

		}else{
			$property = $this->get_property($obj, $key, $options);
		}


        if($property){
        	if($options["format"]) return $solid->format($property->{$property->db->get_prefix()."_value"});
            return $solid->parse($property->{$property->db->get_prefix()."_value"});
        }

        return $options["default"];
    }
    //--------------------------------------------------------------------------------
    public function delete_prop($obj, $key, $options = []) {
    	$options = array_merge([
    	    "force" => true,
    	], $options);

    	$property = $this->get_property($obj, $key, $options);

    	if($property){

    		$property->messages = false;
    		$property->delete();

    		if(isset($obj->property_arr[$property->id]))
    			unset($obj->property_arr[$property->id]);
		}
	}
    //--------------------------------------------------------------------------------

    /**
     * @param $obj
     * @param bool $key
     * @param array $options
     * @return array
     */
    public function get_property_arr($obj, $key = false, $options = []) {

        $options = array_merge([
            "force" => false,
        ], $options);

        $property_table = $this->get_property_table($obj);
        if(!$property_table) \Kwerqy\Ember\com\error\error::create("{$this->name} does not have a property table configured.");

        $this->load_properties($obj, $options);

        if($key){
            $property_dbt = \Kwerqy\Ember\Ember::dbt($property_table);
            $options[".{$property_dbt->get_prefix()}_key"] = $key;
        }else return $obj->property_arr;

        if($property_table) {
            $property_dbt = \Kwerqy\Ember\Ember::dbt($property_table);
            return array_filter($obj->property_arr, function($property)use($key, $property_dbt){
                return $property->{$property_dbt->get_prefix()."_key"} == $key;
            });
        }

        return [];

    }
    //--------------------------------------------------------------------------
}
