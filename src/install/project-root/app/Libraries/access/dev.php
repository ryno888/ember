<?php

namespace access;

/**
 * @package mod\debug
 * @author Ryno Van Zyl
 */
class dev extends \Kwerqy\Ember\com\auth\intf\access {
    //--------------------------------------------------------------------------------
    /**
     * @param \Kwerqy\Ember\com\auth\token $token
     * @return bool
     */
    public function check($token) {
        return in_array($token->get_active_role(), [
            USER_ROLE_DEV,
        ]);
    }
    //--------------------------------------------------------------------------------
}