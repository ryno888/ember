<?php
namespace Kwerqy\Ember\com\solid_classes\person_property;

/**
 * @package app\property_set\solid_classes\person
 * @author Ryno Van Zyl
 * @copyright Copyright Kwerqy. All rights reserved.
 */

class allow_email_notification_new_responses extends \Kwerqy\Ember\com\solid_classes\intf\dbrow {

	//--------------------------------------------------------------------------------
	public function get_display_name() : string {
		return "Allow email notification for new responses";
	}
	//--------------------------------------------------------------------------------
	public function get_code() : string {
		return "PERSON_PROPERTY_ALLOW_EMAIL_NOTIFICATION_NEW_RESPONSES";
	}
	//--------------------------------------------------------------------------------
	public function get_key() : string {
		return "gs1.person.property:ALLOW_EMAIL_NOTIFICATION_NEW_RESPONSES";
	}
	//--------------------------------------------------------------------------------
	public function get_data_type() {
		TYPE_BOOL;
	}
	//--------------------------------------------------------------------------------
}
