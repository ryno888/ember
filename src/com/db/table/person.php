<?php

namespace Kwerqy\Ember\com\db\table;

/**
 * @package app\acc\section
 * @author Ryno Van Zyl
 */
class person extends \Kwerqy\Ember\com\db\intf\table {

	public string $name = "person";
	public string $key = "per_id";
	public string $display = "per_name";

	public string $display_name = "person";
	public string $string = "per_email";
	public string $slug = "per_slug";

	public array $field_arr = array(
	 	// identification
		"per_id" 						=> array("database id"				, "null"    , TYPE_KEY),
		"per_name" 						=> array("name"						, ""	    , TYPE_STRING),
		"per_title" 					=> array("title"					, 0		    , TYPE_ENUM),
		"per_initial" 					=> array("initials"					, "" 	    , TYPE_STRING),
		"per_firstname" 				=> array("first names"				, ""	    , TYPE_STRING),
		"per_lastname" 					=> array("surname"					, ""	    , TYPE_STRING),
		"per_preferredname" 			=> array("preferred name"			, ""	    , TYPE_STRING),
		"per_idnr" 						=> array("identity number"			, ""	    , TYPE_STRING),
		"per_idnr_clean" 				=> array("clean identity number"	, ""	    , TYPE_STRING),
		"per_passportnr" 				=> array("passport number"			, ""	    , TYPE_STRING),
		"per_taxnr" 					=> array("tax number"				, ""	    , TYPE_STRING),
		"per_vatnr" 					=> array("vat number"				, ""	    , TYPE_STRING),
		"per_findstring" 				=> array("find string"				, ""	    , TYPE_STRING),
		"per_tradingname" 				=> array("trading name"				, ""	    , TYPE_STRING),
		"per_maidenname" 				=> array("maiden name"				, "" 	    , TYPE_STRING),
		"per_birthday" 					=> array("birthday"					, "null"    , TYPE_DATE),
		"per_gender" 					=> array("gender"					, 0 	    , TYPE_ENUM),
		"per_jobtitle" 					=> array("job title"				, ""	    , TYPE_STRING),
		"per_is_deceased" 				=> array("is deceased"				, 0		    , TYPE_BOOL),
		// contact
		"per_telnr_home" 				=> array("home number"				, ""	    , TYPE_TELNR),
		"per_telnr_work"				=> array("work number"				, ""	    , TYPE_TELNR),
		"per_cellnr"					=> array("cell number"				, ""	    , TYPE_TELNR),
		"per_faxnr"						=> array("fax number"				, ""	    , TYPE_TELNR),
		"per_email" 					=> array("email"					, ""	    , TYPE_EMAIL),
		"per_email_work" 				=> array("work email"				, ""	    , TYPE_EMAIL),
		"per_website"	 				=> array("website"					, ""	    , TYPE_STRING),

		// account
		"per_username" 					=> array("username"					, ""	    , TYPE_STRING),
		"per_password" 					=> array("password"					, "null"    , TYPE_STRING),
		"per_is_active" 				=> array("is active"				, 0		    , TYPE_BOOL),
		"per_date_login"				=> array("login date"				, "null"    , TYPE_DATE),
		"per_date_login_previous"		=> array("previous login date"		, "null"    , TYPE_DATE),
		"per_retry_count"				=> array("login retry count"		, 0		    , TYPE_INT),
		"per_retry_date"				=> array("last login try date"		, "null"    , TYPE_DATE),
		"per_enable_concurrent_login" 	=> array("enable concurrent login"	, 0		    , TYPE_BOOL),
        "per_slug" 					    => array("slug"					    , ""	    , TYPE_STRING),
	);

	//--------------------------------------------------------------------------------
    public function on_insert(&$obj) {

        if(!isset($obj->__dont_encrypt_password))
            $obj->per_password = \Kwerqy\Ember\com\str\str::encrypt_password($obj->per_password);
    }

    //--------------------------------------------------------------------------------
    public function format_name($obj, $options = []): string {

        $options = array_merge([
            "field_arr" => ["per_firstname", "per_lastname"],
        ], $options);

        return parent::format_name($obj, $options);
    }
    //--------------------------------------------------------------------------------
    public function install_defaults($options = []) {

        $sql = \Kwerqy\Ember\com\db\sql\select::make();
        $sql->select("person.*");
        $sql->from("person");
        $sql->and_where("EXISTS( SELECT pel_id FROM person_role JOIN acl_role ON(pel_ref_acl_role = acl_id)  WHERE pel_ref_person = per_id AND acl_code IN (".dbvalue(USER_ROLE_DEV).") ) ");

        $person = $this->get_fromsql($sql);

        if(!$person){
            $person = $this->get_fromdefault();
            $person->per_firstname = "System";
            $person->per_lastname = "Dev";
            $person->per_username = "admin";
            $person->per_password = "admin1";
            $person->per_is_active = 1;
            $person->insert();

            $person->add_role(USER_ROLE_DEV);
        }

    }
    //--------------------------------------------------------------------------------
    public function add_role($obj, string $acl_code, $options = []) {

        $options = array_merge([
        ], $options);

        if(!$obj->has_role($acl_code)){

            $person_role = \Kwerqy\Ember\Ember::dbt("person_role")->get_fromdefault();
            $person_role->pel_ref_person = $obj->id;
            $person_role->pel_ref_acl_role = \Kwerqy\Ember\Ember::dbt("acl_role")->splatid($acl_code);
            $person_role->insert();
        }

    }
    //--------------------------------------------------------------------------------

    /**
     * @param $obj
     * @param string $acl_code
     * @param array $options
     * @return bool
     */
    public function has_role($obj, string $acl_code, $options = []) {

        $options = array_merge([
        ], $options);

        $sql = \Kwerqy\Ember\com\db\sql\select::make();
        $sql->select("person_role.*");
        $sql->from("person_role");
        $sql->left_join("acl_role", "pel_ref_acl_role = acl_id");
        $sql->and_where("pel_ref_person = ".dbvalue($obj->id));
        $sql->and_where("acl_code = ".dbvalue($acl_code));

        return (bool) \Kwerqy\Ember\Ember::db()->selectsingle($sql);

    }
    //--------------------------------------------------------------------------------
    /**
     * @param $person
     * @param array $options
     * @return array
     */
    public function get_role_list($person, $options = []): array {

        $sql = \Kwerqy\Ember\com\db\sql\select::make();
        $sql->select("acl_id");
        $sql->select("acl_name");
        $sql->from("acl_role");
        $sql->left_join("person_role", "pel_ref_acl_role = acl_id");
        $sql->and_where("pel_ref_person = ".dbvalue($person->per_id));
        $sql->orderby("acl_level", "DESC");

        return \Kwerqy\Ember\Ember::db()->selectlist($sql, "acl_id", "acl_name");

    }
	//--------------------------------------------------------------------------------

    /**
     * @param $person
     * @param array $options
     * @return false|mixed
     */
    public function get_highest_role($person, $options = []) {

        $sql = \Kwerqy\Ember\com\db\sql\select::make();
        $sql->select("acl_code");
        $sql->from("acl_role");
        $sql->left_join("person_role", "pel_ref_acl_role = acl_id");
        $sql->and_where("pel_ref_person = ".dbvalue($person->per_id));
        $sql->orderby("acl_level", "DESC");

        return \Kwerqy\Ember\Ember::db()->selectsingle($sql->build());

    }
	//--------------------------------------------------------------------------------
}