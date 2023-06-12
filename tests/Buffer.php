<?php

include_once "../src/Ember.php";

class Buffer extends \Kwerqy\Ember\com\intf\standard {

    //--------------------------------------------------------------------------------
    public function run() {

        $buffer = \Kwerqy\Ember\Ember::ui()->buffer();

        $buffer->div_([".container" => true]);
            $buffer->div_([".row" => true]);
                $buffer->div_([".col" => true]);
                    $buffer->xheader(1, "Test");
                $buffer->_div();
            $buffer->_div();
        $buffer->_div();

        $buffer->flush();

    }
    //--------------------------------------------------------------------------------
}

Buffer::make()->run();