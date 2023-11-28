<?php

namespace app\ui\set;

/**
 * @package mod\ui\set\system
 * @author Ryno Van Zyl
 */
class bootstrap extends \Kwerqy\Ember\com\ui\set\bootstrap {
	//--------------------------------------------------------------------------------
    protected function get_class_name($name){

	    //evaluate library folder
	    if(file_exists(APPPATH."Libraries/app/ui/set/bootstrap/$name.php")){
	        return "\\app\\ui\\set\\bootstrap\\$name";
        }

		//evaluate app - bootstrap folder
	    if(file_exists(DIR_COM."/ui/set/website/$name.php")){
	        return "\\Kwerqy\\Ember\\com\\ui\set\\website\\{$name}";
        }
        //default to com
	    return "\\Kwerqy\\Ember\\com\\ui\set\\bootstrap\\{$name}";

    }
	//--------------------------------------------------------------------------------
}