<?php

namespace Kwerqy\Ember\com\auth\intf;

/**
 * @package mod\debug
 * @author Ryno Van Zyl
 */
abstract class access extends \Kwerqy\Ember\com\intf\standard {
    //--------------------------------------------------------------------------------
    /**
     * @param $token \Kwerqy\Ember\com\auth\token
     * @return bool
     */
    public abstract function check($token);
    //--------------------------------------------------------------------------------
}