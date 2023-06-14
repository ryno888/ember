<?php




\Kwerqy\Ember\com\ui\ui::make()->ci_view((empty($controller) ?: $controller), function($buffer, $controller, $view){

    /**
     * @var $buffer \Kwerqy\Ember\com\ui\set\bootstrap\html
     * @var $controller \Kwerqy\Ember\com\ci\controller\controller
     * @var $view \Kwerqy\Ember\com\ci\view\view
     */

    $buffer->form("xryno/xtest");
    $buffer->section_([".banner-wrapper" => true, ]);
        $buffer->div_([".container" => true]);
            $buffer->div_([".row" => true]);
                $buffer->div_([".col" => true]);
                    $buffer->xheader(1, "Test");
                $buffer->_div();
                $buffer->div_([".col" => true]);
                    $buffer->submit_button();
                $buffer->_div();
            $buffer->_div();
        $buffer->_div();
    $buffer->_section();

});

