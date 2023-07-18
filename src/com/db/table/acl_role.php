<?php

namespace Kwerqy\Ember\com\db\table;

/**
 * @package db
 * @author Ryno Van Zyl
 */
class acl_role extends \Kwerqy\Ember\com\db\intf\table {
	//--------------------------------------------------------------------------------
	// properties
	//--------------------------------------------------------------------------------
	public string $name = "acl_role";
	public string $key = "acl_id";
	public string $display = "acl_name";

	public string $display_name = "Acl Role";
	public string $string = "acl_code";
	public string $slug = "acl_slug";

	public array $field_arr = array( // FIELDNAME => DISPLAY[0] DEFAULT[1] TYPE[2] REFERENCE[3]
		"acl_id"			=> array("Id"				, "null"	, TYPE_KEY),
		"acl_name"			=> array("Name"				, ""		, TYPE_VARCHAR),
		"acl_code"			=> array("Code"				, ""		, TYPE_VARCHAR),
		"acl_is_locked"		=> array("Is Locked"		, 0		    , TYPE_TINYINT),
		"acl_level"			=> array("Level"			, 0.00000	, TYPE_DECIMAL),
		"acl_slug"			=> array("slug"				, ""		, TYPE_VARCHAR),
	);
 	//--------------------------------------------------------------------------------
    public function install_defaults($options = []) {
        $acl_role_arr = [];
        $acl_role_arr[] = "USER_ROLE_ADMIN";
        $acl_role_arr[] = "USER_ROLE_DEV";
        $acl_role_arr[] = "USER_ROLE_CLIENT";

        foreach ($acl_role_arr as $constant){
            $role = \Kwerqy\Ember\com\solid_classes\helper::make()->get_from_constant($constant);
            $this->install_role($role->get_value(), $role->get_display_name(), $role->get_level());
        }
    }
    //--------------------------------------------------------------------------------
    public function install_role(string $constant, string $name, int $level, $options = []) {
        $obj = \Kwerqy\Ember\Ember::dbt("acl_role")->find([
            ".acl_code" => $constant,
            "create" => true,
        ]);

        if($obj->source == "new"){
            $obj->acl_code = $constant;
            $obj->acl_name = $name;
            $obj->acl_level = $level;

            $field_arr = \Kwerqy\Ember\com\arr\arr::extract_signature_items(".", $options);
            foreach ($field_arr as $field => $value){
                $obj->{$field} = $value;
            }

            $obj->insert();
        }
    }
    //--------------------------------------------------------------------------------
}