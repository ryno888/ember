<?php

\Kwerqy\Ember\com\ui\ui::make()->ci_view((empty($controller) ?: $controller), function($buffer, $controller, $view){

    /**
     * @var $buffer \Kwerqy\Ember\com\ui\set\bootstrap\html
     * @var $controller \Kwerqy\Ember\com\ci\controller\controller
     * @var $view \Kwerqy\Ember\com\ci\view\view
     */

    $str = '';

    $builder = \Kwerqy\Ember\com\factory\buffer_builder\builder::make();
    $builder->add_html($str);

    $buffer->xitextarea("html", $builder->build(["wrap" => false]), false, ["rows" => 30]);

});

