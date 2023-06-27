<?php
namespace section;

class website extends \Kwerqy\Ember\com\intf\section {
    //--------------------------------------------------------------------------------
	public function get_set() {
		return "website";
	}
	//--------------------------------------------------------------------------------
    public function get_layout() {
        return "website";
    }
	//--------------------------------------------------------------------------------
    /**
     * @param array $options
     * @return \Kwerqy\Ember\com\ui\intf\set
     */
	public function get_ui($options = []) {

	    if(file_exists(APPPATH."Libraries/app/ui/set/website.php")){
            return call_user_func(["\\app\\ui\\set\\website", "make"]);
        }

		return \Kwerqy\Ember\com\ui\set\website::make($options);
	}
    //--------------------------------------------------------------------------------
}