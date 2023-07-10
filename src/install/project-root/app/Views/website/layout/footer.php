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

    $buffer->footer_([".py-3 my-4" => true, ]);
        $buffer->ul_([".nav justify-content-center border-bottom pb-3 mb-3" => true, ]);
            $fn_link = function($label, $link)use(&$buffer){
                $buffer->li_([".nav-item" => true, ]);
                    $buffer->xlink($link, $label, [".nav-link px-2 text-muted" => true]);
                $buffer->_li();
            };
            foreach ($link_arr as $label => $link) $fn_link($label, $link);
        $buffer->_ul();
        $buffer->p_([".text-center text-muted" => true, ]);
            $buffer->add(\Kwerqy\Ember\Ember::get_copyright());
        $buffer->_p();
    $buffer->_footer();
    
});
