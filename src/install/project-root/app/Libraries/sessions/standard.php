<?php
namespace sessions;

class standard extends \Kwerqy\Ember\com\session\intf\session_helper {

    public $example = "";

    //--------------------------------------------------------------------------------
    protected function __construct($options = []) {

        //init before load

        //load
        parent::__construct($options);
    }
    //--------------------------------------------------------------------------------
}