<?php

\Kwerqy\Ember\com\ui\ui::make()->ci_view((empty($controller) ?: $controller), function($buffer, $controller, $view){

    /**
     * @var $buffer \Kwerqy\Ember\com\ui\set\bootstrap\html
     * @var $controller \Kwerqy\Ember\com\ci\controller\controller
     * @var $view \Kwerqy\Ember\com\ci\view\view
     */

    if(file_exists(DIR_TEMP."/console.txt")){
        $buffer->xdebug();
        $buffer->pre_(["." => true]);
            $buffer->add(file_get_contents(DIR_TEMP."/console.txt"));
        $buffer->_pre();
    }

});

