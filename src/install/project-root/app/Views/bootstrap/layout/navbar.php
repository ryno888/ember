<?php
\Kwerqy\Ember\com\ui\ui::make()->ci_view((empty($controller) ?: $controller), function($buffer, $controller, $view){

    /**
     * @var $buffer \Kwerqy\Ember\com\ui\set\bootstrap\html
     * @var $controller \Kwerqy\Ember\com\ci\controller\controller
     * @var $view \Kwerqy\Ember\com\ci\view\view
     */

    $buffer->section_();
        $navbar = \Kwerqy\Ember\com\ui\ui::make()->navbar();
        $navbar->add_item("Home", site_url("website/index/home"));
        $navbar->add_item("About", site_url("website/index/about"));
        $navbar->add_item("Contact", site_url("website/index/contact"));
        $buffer->add($navbar->build());
    $buffer->_section();

});
