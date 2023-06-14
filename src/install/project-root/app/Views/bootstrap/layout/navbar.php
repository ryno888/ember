<?php
\Kwerqy\Ember\com\ui\ui::make()->ci_view((empty($controller) ?: $controller), function($buffer, $controller, $view){

    /**
     * @var $buffer \Kwerqy\Ember\com\ui\set\bootstrap\html
     * @var $controller \Kwerqy\Ember\com\ci\controller\controller
     * @var $view \Kwerqy\Ember\com\ci\view\view
     */

    $link_arr = [];
    $link_arr["Home"] = site_url("website/index/home");
    $link_arr["About"] = site_url("website/index/about");
    $link_arr["Contact"] = site_url("website/index/contact");

    $buffer->section_();
        $navbar = \Kwerqy\Ember\com\ui\ui::make()->navbar();
        foreach ($link_arr as $label => $url) $navbar->add_item($label, $url);
        $buffer->add($navbar->build());
    $buffer->_section();
    
});
