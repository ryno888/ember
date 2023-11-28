<?php
namespace release;

/**
 * @package mod\solid_classes
 * @author Ryno Van Zyl
 */

class ember_1 extends \Kwerqy\Ember\com\release\intf\release {
    //--------------------------------------------------------------------------------
    public function get_environment():string {
        return "testing";
    }
    //--------------------------------------------------------------------------------
    public function get_code():string {
        return "!EMBER1";
    }
    //--------------------------------------------------------------------------------
    public function get_description():string {
        return "Category product module";
    }
    //--------------------------------------------------------------------------------
}

