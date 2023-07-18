<?php

namespace Kwerqy\Ember\com\db\table;

/**
 * Database Class.
 *
 * @author Liquid Edge Solutions
 * @copyright Copyright Liquid Edge Solutions. All rights reserved.
 */
class person_role extends \Kwerqy\Ember\com\db\intf\table {
	//--------------------------------------------------------------------------------
	// properties
	//--------------------------------------------------------------------------------
	public string $name = "person_role";
	public string $key = "pel_id";
	public string $display = "pel_ref_person";

	public string $display_name = "person role";

	public array $field_arr = array( // FIELDNAME => DISPLAY[0] DEFAULT[1] TYPE[2] REFERENCE[3]
		"pel_id"			=> array("id"		, "null", TYPE_KEY),
		"pel_ref_person"	=> array("person"	, "null", TYPE_REFERENCE, "person"),
		"pel_ref_acl_role"	=> array("acl role"	, "null", TYPE_REFERENCE, "acl_role"),
	);
 	//--------------------------------------------------------------------------------
}