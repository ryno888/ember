<?php

namespace Kwerqy\Ember\com\release\intf;

/**
 * @package Kwerqy\Ember\com\release
 * @author Ryno Van Zyl
 * @copyright Copyright Liquid Edge Solutions. All rights reserved.
 */
abstract class release extends \Kwerqy\Ember\com\intf\standard {
    //--------------------------------------------------------------------------------
    public abstract function get_environment():string;
    public abstract function get_code():string;
    public abstract function get_description():string;
    //--------------------------------------------------------------------------------
    public function is_active() :bool{
        
        $environment_arr = [
            0 => "production",
            1 => "testing",
            2 => "development",
        ];
        
        $current_level = array_search(getenv("CI_ENVIRONMENT"), $environment_arr);
        $release_level = array_search($this->get_environment(), $environment_arr);

        return $release_level<= $current_level;
    }
    //--------------------------------------------------------------------------------
}