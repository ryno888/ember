<?php

namespace Kwerqy\Ember\com\factory\coder;

class coder extends \Kwerqy\Ember\com\intf\standard {

    //--------------------------------------------------------------------------------
    public function run() {
        \Kwerqy\Ember\com\factory\coder\codeIgniter\install_common_php::make();
        \Kwerqy\Ember\com\factory\coder\codeIgniter\install_controllers::make();
        \Kwerqy\Ember\com\factory\coder\codeIgniter\install_views::make();
        \Kwerqy\Ember\com\factory\coder\codeIgniter\install_dbs::make();
    }
    //--------------------------------------------------------------------------------
    
}