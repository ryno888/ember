<?php

namespace Kwerqy\Ember\com\factory\coder\codeIgniter;

class install_dbs extends \Kwerqy\Ember\com\intf\standard {

    //--------------------------------------------------------------------------------

	public function build($options = []) {
        $this->install_acl_role();
        $this->install_address();
        $this->install_country();
        $this->install_email();
        $this->install_email_file_item();
        $this->install_email_person();
        $this->install_file_data();
        $this->install_file_item();
        $this->install_language();
        $this->install_person();
        $this->install_person_role();
        $this->install_person_type();
        $this->install_suburb();
        $this->install_province();
        $this->install_town();
	}
	//--------------------------------------------------------------------------------
    private function install_town() {
        $this->install_file(DIR_APP."/Libraries/db/town.php", <<<EOD
<?php

namespace db;

/**
 * @package db
 * @author Ryno Van Zyl
 */
class town extends \\Kwerqy\\Ember\com\\db\\intf\\table {
	//--------------------------------------------------------------------------------
	// properties
	//--------------------------------------------------------------------------------
	public string \$name = "town";
	public string \$key = "tow_id";
	public string \$display = "tow_name";

	public string \$display_name = "Town";
	public string \$slug = "tow_slug";

	public array \$field_arr = array( // FIELDNAME => DISPLAY[0] DEFAULT[1] TYPE[2] REFERENCE[3]
		"tow_id"			=> array("Id"		    , "null"    , TYPE_KEY, ),
        "tow_name"			=> array("Name"		    , ""        , TYPE_VARCHAR, ),
        "tow_name_af"	    => array("Name Af"		, ""        , TYPE_VARCHAR, ),
        "tow_ref_province"	=> array("Ref Province"	, "null"    , TYPE_INT, "province"),
        "tow_ref_country"	=> array("Ref Country"	, "null"    , TYPE_INT, "country"),
        "tow_slug"	        => array("slug"		    , ""        , TYPE_VARCHAR, ),
	);
 	//--------------------------------------------------------------------------------
}
EOD);
    }
	//--------------------------------------------------------------------------------
    private function install_province() {
        $this->install_file(DIR_APP."/Libraries/db/province.php", <<<EOD
<?php

namespace db;

/**
 * @package db
 * @author Ryno Van Zyl
 */
class province extends \\Kwerqy\\Ember\com\\db\\intf\\table {
	//--------------------------------------------------------------------------------
	// properties
	//--------------------------------------------------------------------------------
	public string \$name = "province";
	public string \$key = "prv_id";
	public string \$display = "prv_name";

	public string \$display_name = "Province";
	public string \$slug = "prv_slug";

	public array \$field_arr = array( // FIELDNAME => DISPLAY[0] DEFAULT[1] TYPE[2] REFERENCE[3]
		"prv_id"			=> array("Id"		    , "null"    , TYPE_KEY, ),
        "prv_name"			=> array("Name"		    , ""        , TYPE_VARCHAR, ),
        "prv_ref_country"   => array("Ref Country"  , "null"    , TYPE_INT, "country"),
        "prv_slug"			=> array("slug"		    , ""        , TYPE_VARCHAR, ),
	);
 	//--------------------------------------------------------------------------------
}
EOD);
    }
	//--------------------------------------------------------------------------------
    private function install_suburb() {
        $this->install_file(DIR_APP."/Libraries/db/suburb.php", <<<EOD
<?php

namespace db;

/**
 * @package db
 * @author Ryno Van Zyl
 */
class suburb extends \\Kwerqy\\Ember\com\\db\\intf\\table {
	//--------------------------------------------------------------------------------
	// properties
	//--------------------------------------------------------------------------------
	public string \$name = "suburb";
	public string \$key = "sub_id";
	public string \$display = "sub_name";

	public string \$display_name = "Suburb";
	public string \$slug = "sub_slug";

	public array \$field_arr = array( // FIELDNAME => DISPLAY[0] DEFAULT[1] TYPE[2] REFERENCE[3]
		"sub_id"			    => array("Id"		        , "null"    , TYPE_KEY, ),
        "sub_name"			    => array("Name"		        , ""        , TYPE_VARCHAR, ),
        "sub_name_af"			=> array("Name Af"		    , ""        , TYPE_VARCHAR, ),
        "sub_ref_town"			=> array("Ref Town"		    , "null"    , TYPE_INT, "town"),
        "sub_postal_code"	    => array("Postal Code"		, ""        , TYPE_VARCHAR, ),
        "sub_residential_code"  => array("Residential Code" , ""        , TYPE_VARCHAR, ),
        "sub_slug"              => array("slug"             , ""        , TYPE_VARCHAR, ),
	);
 	//--------------------------------------------------------------------------------
}
EOD);
    }
	//--------------------------------------------------------------------------------
    private function install_person_type() {
        $this->install_file(DIR_APP."/Libraries/db/person_type.php", <<<EOD
<?php

namespace db;

/**
 * @package db
 * @author Ryno Van Zyl
 */
class person_type extends \\Kwerqy\\Ember\com\\db\\intf\\table {
	//--------------------------------------------------------------------------------
	// properties
	//--------------------------------------------------------------------------------
	public string \$name = "person_type";
	public string \$key = "pty_id";
	public string \$display = "pty_name";

	public string \$display_name = "Person Type";

	public array \$field_arr = array( // FIELDNAME => DISPLAY[0] DEFAULT[1] TYPE[2] REFERENCE[3]
		"pty_id"			    => array("Id"		            , "null"    , TYPE_KEY, ),
        "pty_name"			    => array("Name"		            , ""        , TYPE_VARCHAR, ),
        "pty_is_individual"	    => array("Is Individual"        , "0"       , TYPE_TINYINT, ),
        "pty_code"			    => array("Code"		            , ""        , TYPE_VARCHAR, ),
        "pty_is_international"	=> array("Is International"		, 0         , TYPE_TINYINT, ),
	);
 	//--------------------------------------------------------------------------------
}
EOD);
    }
	//--------------------------------------------------------------------------------
    private function install_person_role() {
        $this->install_file(DIR_APP."/Libraries/db/person_role.php", <<<EOD
<?php

namespace db;

/**
 * Database Class.
 *
 * @author Liquid Edge Solutions
 * @copyright Copyright Kwerqy. All rights reserved.
 */
class person_role extends \\Kwerqy\\Ember\com\\db\\intf\\table {
	//--------------------------------------------------------------------------------
	// properties
	//--------------------------------------------------------------------------------
	public string \$name = "person_role";
	public string \$key = "pel_id";
	public string \$display = "pel_ref_person";

	public string \$display_name = "person role";

	public array \$field_arr = array( // FIELDNAME => DISPLAY[0] DEFAULT[1] TYPE[2] REFERENCE[3]
		"pel_id"			=> array("id"		, "null", TYPE_KEY),
		"pel_ref_person"	=> array("person"	, "null", TYPE_REFERENCE, "person"),
		"pel_ref_acl_role"	=> array("acl role"	, "null", TYPE_REFERENCE, "acl_role"),
	);
 	//--------------------------------------------------------------------------------
}
EOD);
    }
	//--------------------------------------------------------------------------------
    private function install_person() {
        $this->install_file(DIR_APP."/Libraries/db/person.php", <<<EOD
<?php

namespace db;

/**
 * @package app\acc\section
 * @author Ryno Van Zyl
 */
class person extends \\Kwerqy\\Ember\com\\db\\intf\\table {

	public string \$name = "person";
	public string \$key = "per_id";
	public string \$display = "per_name";

	public string \$display_name = "person";
	public string \$string = "per_email";
	public string \$slug = "per_slug";

	public array \$field_arr = array(
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
    public function on_insert(\$obj) {

        if(!isset(\$obj->__dont_encrypt_password))
            \$obj->per_password = \Kwerqy\Ember\com\str\str::encrypt_password(\$obj->per_password);
    }

    //--------------------------------------------------------------------------------
    public function format_name(\$obj, \$options = []): string {

        \$options = array_merge([
            "field_arr" => ["per_firstname", "per_lastname"],
        ], \$options);

        return parent::format_name(\$obj, \$options);
    }
    //--------------------------------------------------------------------------------
    /**
     * @param \$person
     * @param array \$options
     * @return array
     */
    public function get_role_list(\$person, \$options = []): array {

        \$sql = \Kwerqy\Ember\com\db\sql\select::make();
        \$sql->select("acl_id");
        \$sql->select("acl_name");
        \$sql->from("acl_role");
        \$sql->left_join("person_role", "pel_ref_acl_role = acl_id");
        \$sql->and_where("pel_ref_person = ".dbvalue(\$person->per_id));
        \$sql->orderby("acl_level", "DESC");

        return \Kwerqy\Ember\Ember::db()->selectlist(\$sql, "acl_id", "acl_name");

    }
	//--------------------------------------------------------------------------------

    /**
     * @param \$person
     * @param array \$options
     * @return false|mixed
     */
    public function get_highest_role(\$person, \$options = []) {

        \$sql = \Kwerqy\Ember\com\db\sql\select::make();
        \$sql->select("acl_code");
        \$sql->from("acl_role");
        \$sql->left_join("person_role", "pel_ref_acl_role = acl_id");
        \$sql->and_where("pel_ref_person = ".dbvalue(\$person->per_id));
        \$sql->orderby("acl_level", "DESC");

        return \Kwerqy\Ember\Ember::db()->selectsingle(\$sql->build());

    }
	//--------------------------------------------------------------------------------
}
EOD);
    }
	//--------------------------------------------------------------------------------
    private function install_language() {
        $this->install_file(DIR_APP."/Libraries/db/language.php", <<<EOD
<?php

namespace db;

/**
 * @package db
 * @author Ryno Van Zyl
 */
class language extends \\Kwerqy\\Ember\com\\db\\intf\\table {
	//--------------------------------------------------------------------------------
	// properties
	//--------------------------------------------------------------------------------
	public string \$name = "language";
	public string \$key = "lan_id";
	public string \$display = "lan_name";

	public string \$display_name = "Language";

	public array \$field_arr = array( // FIELDNAME => DISPLAY[0] DEFAULT[1] TYPE[2] REFERENCE[3]
		"lan_id"			=> array("Id"		, "null"    , TYPE_KEY, ),
        "lan_name"			=> array("Name"		, ""        , TYPE_VARCHAR, ),
	);
 	//--------------------------------------------------------------------------------
}
EOD);
    }
	//--------------------------------------------------------------------------------
    private function install_file_item() {
        $this->install_file(DIR_APP."/Libraries/db/file_item.php", <<<EOD
<?php

namespace db;

/**
 * @package db
 * @author Ryno Van Zyl
 */
class file_item extends \\Kwerqy\\Ember\com\\db\\intf\\table {
	//--------------------------------------------------------------------------------
	// properties
	//--------------------------------------------------------------------------------
	public string \$name = "file_item";
	public string \$key = "fil_id";
	public string \$display = "fil_id";

	public string \$display_name = "File Item";

	public array \$field_arr = array( // FIELDNAME => DISPLAY[0] DEFAULT[1] TYPE[2] REFERENCE[3]
		"fil_id"					=> array("Id"				, "null"	, TYPE_KEY,),
		"fil_name"					=> array("Name"				, ""		, TYPE_VARCHAR,),
		"fil_note"					=> array("Note"				, ""		, TYPE_VARCHAR,),
		"fil_date_added"			=> array("Date Added"		, "null"	, TYPE_DATETIME,),
		"fil_date_updated"			=> array("Date Updated"		, "null"	, TYPE_DATETIME,),
		"fil_filename"				=> array("Filename"			, ""		, TYPE_VARCHAR,),
		"fil_link_path"				=> array("Link Path"		, ""		, TYPE_VARCHAR,),
		"fil_source_path"			=> array("Source Path"		, ""		, TYPE_VARCHAR,),
		"fil_source_host"			=> array("Source Host"		, ""		, TYPE_VARCHAR,),
		"fil_size"					=> array("Size"				, 0		    , TYPE_INT,),
		"fil_ref_person_added"		=> array("Ref Person Added"	, "null"	, TYPE_INT	, "person"),
		"fil_type"					=> array("Type"				, 0		    , TYPE_TINYINT,),
		"fil_version"				=> array("Version"			, ""		, TYPE_VARCHAR,),
		"fil_date_version"			=> array("Date Version"		, "null"	, TYPE_DATETIME,),
		"fil_extension"				=> array("Extension"		, ""		, TYPE_VARCHAR,),
		"fil_ref_file_data"			=> array("Ref File Data"	, "null"	, TYPE_INT	, "file_data"),
		"fil_is_deleted"			=> array("Is Deleted"		, 0		    , TYPE_TINYINT,),
		"fil_ref_file_item"			=> array("Ref File Item"	, "null"	, TYPE_INT	, "file_item"),
	);
 	//--------------------------------------------------------------------------------
}
EOD);
    }
	//--------------------------------------------------------------------------------
    private function install_file_data() {
        $this->install_file(DIR_APP."/Libraries/db/file_data.php", <<<EOD
<?php

namespace db;

/**
 * @package db
 * @author Ryno Van Zyl
 */
class file_data extends \\Kwerqy\\Ember\com\\db\\intf\\table {
	//--------------------------------------------------------------------------------
	// properties
	//--------------------------------------------------------------------------------
	public string \$name = "file_data";
	public string \$key = "fid_id";
	public string \$display = "fid_id";

	public string \$display_name = "File Data";

	public array \$field_arr = array( // FIELDNAME => DISPLAY[0] DEFAULT[1] TYPE[2] REFERENCE[3]
		"fid_id"			=> array("Id"		, "null", TYPE_KEY),
		"fid_data"			=> array("Data"		, "null", TYPE_LONGBLOB),
	);
 	//--------------------------------------------------------------------------------
}
EOD);
    }
	//--------------------------------------------------------------------------------
    private function install_email_person() {
        $this->install_file(DIR_APP."/Libraries/db/email_person.php", <<<EOD
<?php

namespace db;

/**
 * @package db
 * @author Ryno Van Zyl
 */
class email_person extends \\Kwerqy\\Ember\com\\db\\intf\\table {
	//--------------------------------------------------------------------------------
	// properties
	//--------------------------------------------------------------------------------
	public string \$name = "email_person";
	public string \$key = "emp_id";
	public string \$display = "emp_id";

	public string \$display_name = "Email Person";

	public array \$field_arr = array( // FIELDNAME => DISPLAY[0] DEFAULT[1] TYPE[2] REFERENCE[3]
		"emp_id"			=> array("Id"			, "null"	, TYPE_KEY),
		"emp_ref_email"		=> array("Ref Email"	, "null"	, TYPE_INT, "email"),
		"emp_ref_person"	=> array("Ref Person"	, "null"	, TYPE_INT, "person"),
		"emp_type"			=> array("Type"			, 0		    , TYPE_TINYINT),
		"emp_email"			=> array("Email"		, ""		, TYPE_VARCHAR),
		"emp_name"			=> array("Name"			, ""		, TYPE_VARCHAR),
	);
 	//--------------------------------------------------------------------------------
}
EOD);
    }
	//--------------------------------------------------------------------------------
    private function install_email_file_item() {
        $this->install_file(DIR_APP."/Libraries/db/email_file_item.php", <<<EOD
<?php

namespace db;

/**
 * @package db
 * @author Ryno Van Zyl
 */
class email_file_item extends \\Kwerqy\\Ember\com\\db\\intf\\table {
	//--------------------------------------------------------------------------------
	// properties
	//--------------------------------------------------------------------------------
	public string \$name = "email_file_item";
	public string \$key = "emf_id";
	public string \$display = "emf_id";

	public string \$display_name = "Email File Item";

	public array \$field_arr = array( // FIELDNAME => DISPLAY[0] DEFAULT[1] TYPE[2] REFERENCE[3]
		"emf_id"				=> array("Id"				, "null"	, TYPE_KEY),
		"emf_ref_email"			=> array("Ref Email"		, "null"	, TYPE_INT, "email"),
		"emf_ref_file_item"		=> array("Ref File Item"	, "null"	, TYPE_INT, "file_item"),
		"emf_cid"				=> array("Cid"				, ""		, TYPE_VARCHAR),
	);
 	//--------------------------------------------------------------------------------
}
EOD);
    }
	//--------------------------------------------------------------------------------
    private function install_email() {
        $this->install_file(DIR_APP."/Libraries/db/email.php", <<<EOD
<?php

namespace db;

/**
 * @package db
 * @author Ryno Van Zyl
 */
class email extends \\Kwerqy\\Ember\com\\db\\intf\\table {
	//--------------------------------------------------------------------------------
	// properties
	//--------------------------------------------------------------------------------
	public string \$name = "email";
	public string \$key = "ema_id";
	public string \$display = "ema_id";

	public string \$display_name = "Email";

	public array \$field_arr = array( // FIELDNAME => DISPLAY[0] DEFAULT[1] TYPE[2] REFERENCE[3]
		"ema_id"				=> array("Id"				, "null"	, TYPE_KEY),
		"ema_subject"			=> array("Subject"			, ""		, TYPE_VARCHAR),
		"ema_body"				=> array("Body"				, "null"	, TYPE_TEXT),
		"ema_status"			=> array("Status"			, 0		    , TYPE_TINYINT),
		"ema_priority"			=> array("Priority"			, 0		    , TYPE_INT),
		"ema_retry_count"		=> array("Retry Count"		, 0		    , TYPE_INT),

		"ema_date_added"		=> array("Date Added"		, "null"	, TYPE_DATETIME),
		"ema_date_sent"			=> array("Date Sent"		, "null"	, TYPE_DATETIME),
		"ema_date_schedule"		=> array("Date Schedule"	, "null"	, TYPE_DATETIME),

		"ema_error_message"		=> array("Error Message"	, ""		, TYPE_VARCHAR),
		"ema_connection"		=> array("Connection"		, ""		, TYPE_VARCHAR),
		"ema_message_id"		=> array("Message Id"		, ""		, TYPE_VARCHAR),

		"ema_ref_person"		=> array("Ref Person"		, "null"	, TYPE_INT, "person"),
		"ema_ref_email"			=> array("Ref Email"		, "null"	, TYPE_INT, "email"),
		"ema_ref_email_start"	=> array("Ref Email Start"	, "null"	, TYPE_INT, "email"),
	);
 	//--------------------------------------------------------------------------------
}
EOD);
    }
	//--------------------------------------------------------------------------------
    private function install_address() {
        $this->install_file(DIR_APP."/Libraries/db/address.php", <<<EOD
<?php

namespace db;

/**
 * @package db
 * @author Ryno Van Zyl
 */
class address extends \\Kwerqy\\Ember\com\\db\\intf\\table {
	//--------------------------------------------------------------------------------
	// properties
	//--------------------------------------------------------------------------------
	public string \$name = "address";
	public string \$key = "add_id";
	public string \$display = "add_name";

	public string \$display_name = "Address";
	public string \$slug = "add_slug";

	public array \$field_arr = array( // FIELDNAME => DISPLAY[0] DEFAULT[1] TYPE[2] REFERENCE[3]
		"add_id"				=> array("Id"				, "null"	, TYPE_KEY),
		"add_name"				=> array("Name"				, ""		, TYPE_VARCHAR),
		"add_type"				=> array("Type"				, 0		    , TYPE_TINYINT),
		"add_nomination"		=> array("Nomination"		, 0		    , TYPE_TINYINT),
		"add_ref_suburb"		=> array("Ref Suburb"		, "null"	, TYPE_REFERENCE    , "suburb"),
		"add_ref_town"			=> array("Ref Town"			, "null"	, TYPE_REFERENCE    , "town"),
		"add_ref_province"		=> array("Ref Province"		, "null"	, TYPE_REFERENCE    , "province"),
		"add_ref_country"		=> array("Ref Country"		, "null"	, TYPE_REFERENCE    , "country"),
		"add_unitnr"			=> array("Unitnr"			, ""		, TYPE_VARCHAR),
		"add_floor"				=> array("Floor"			, ""		, TYPE_VARCHAR),
		"add_building"			=> array("Building"			, ""		, TYPE_VARCHAR),
		"add_farm"				=> array("Farm"				, ""		, TYPE_VARCHAR),
		"add_streetnr"			=> array("Streetnr"			, ""		, TYPE_VARCHAR),
		"add_street"			=> array("Street"			, ""		, TYPE_VARCHAR),
		"add_development"		=> array("Development"		, ""		, TYPE_VARCHAR),
		"add_attention"			=> array("Attention"		, ""		, TYPE_VARCHAR),
		"add_pobox"				=> array("Pobox"			, ""		, TYPE_VARCHAR),
		"add_postnet"			=> array("Postnet"			, ""		, TYPE_VARCHAR),
		"add_privatebag"		=> array("Privatebag"		, ""		, TYPE_VARCHAR),
		"add_clusterbox"		=> array("Clusterbox"		, ""		, TYPE_VARCHAR),
		"add_line1"				=> array("Line1"			, ""		, TYPE_VARCHAR),
		"add_line2"				=> array("Line2"			, ""		, TYPE_VARCHAR),
		"add_line3"				=> array("Line3"			, ""		, TYPE_VARCHAR),
		"add_line4"				=> array("Line4"			, ""		, TYPE_VARCHAR),
		"add_code"				=> array("Code"				, ""		, TYPE_VARCHAR),
		"add_raw"				=> array("Raw"				, "null"	, TYPE_TEXT),
		"add_ref_person"		=> array("Ref Person"		, "null"	, TYPE_REFERENCE    , "person"),
		"add_ref_address"		=> array("Ref Address"		, "null"	, TYPE_REFERENCE    , "address"),
        "add_slug"			    => array("slug"				, ""		, TYPE_VARCHAR),
	);
 	//--------------------------------------------------------------------------------
}
EOD);
    }
	//--------------------------------------------------------------------------------
    private function install_country() {
        $this->install_file(DIR_APP."/Libraries/db/country.php", <<<EOD
<?php

namespace db;

/**
 * @package db
 * @author Ryno Van Zyl
 */
class country extends \\Kwerqy\\Ember\com\\db\\intf\\table {
	//--------------------------------------------------------------------------------
	// properties
	//--------------------------------------------------------------------------------
	public string \$name = "country";
	public string \$key = "con_id";
	public string \$display = "con_id";

	public string \$display_name = "Country";
	public string \$slug = "con_slug";

	public array \$field_arr = array( // FIELDNAME => DISPLAY[0] DEFAULT[1] TYPE[2] REFERENCE[3]
		"con_id"			=> array("Id"		, "null"	, TYPE_KEY),
		"con_name"			=> array("Name"		, ""		, TYPE_VARCHAR),
		"con_code"			=> array("Code"		, ""		, TYPE_VARCHAR),
		"con_slug"			=> array("slug"		, ""		, TYPE_VARCHAR),
	);
 	//--------------------------------------------------------------------------------
}
EOD);
    }
	//--------------------------------------------------------------------------------
    private function install_acl_role() {
        $this->install_file(DIR_APP."/Libraries/db/acl_role.php", <<<EOD
<?php

namespace db;

/**
 * @package db
 * @author Ryno Van Zyl
 */
class acl_role extends \\Kwerqy\\Ember\com\\db\\intf\\table {
	//--------------------------------------------------------------------------------
	// properties
	//--------------------------------------------------------------------------------
	public string \$name = "acl_role";
	public string \$key = "acl_id";
	public string \$display = "acl_name";

	public string \$display_name = "Acl Role";
	public string \$slug = "acl_slug";

	public array \$field_arr = array( // FIELDNAME => DISPLAY[0] DEFAULT[1] TYPE[2] REFERENCE[3]
		"acl_id"			=> array("Id"				, "null"	, TYPE_KEY),
		"acl_name"			=> array("Name"				, ""		, TYPE_VARCHAR),
		"acl_code"			=> array("Code"				, ""		, TYPE_VARCHAR),
		"acl_is_locked"		=> array("Is Locked"		, 0		    , TYPE_TINYINT),
		"acl_level"			=> array("Level"			, 0.00000	, TYPE_DECIMAL),
		"acl_slug"			=> array("slug"				, ""		, TYPE_VARCHAR),
	);
 	//--------------------------------------------------------------------------------
}
EOD);
    }
    //--------------------------------------------------------------------------------
    public function install_file($filename, $content) {
        if(file_exists($filename)) return;

		\Kwerqy\Ember\com\os\os::mkdir(dirname($filename));
		file_put_contents($filename, $content);
    }
    //--------------------------------------------------------------------------------

}