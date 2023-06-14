<?php
\Kwerqy\Ember\com\ui\ui::make()->ci_view((empty($controller) ?: $controller), function($buffer, $controller, $view){

    $buffer->xloader();

    $buffer->section_([".banner-wrapper" => true, ]);
        $buffer->div_([".container" => true, ]);
            $buffer->div_([".row py-3" => true, ]);
                $buffer->div_([".col text-center" => true, ]);
                    $buffer->span_([".text-white" => true, ]);
                        $buffer->add("JOIN NOW:");
                        $buffer->xlink("javascript:app.browser.popup('".\Kwerqy\Ember\com\http\http::build_action_url("website/index/newsletter_signup")."', {title:'Sign up to our newsletter', width:'modal-md'})", "Sign up to our newsletter", [".ms-2 text-warning" => true]);
                    $buffer->_span();
                $buffer->_div();
            $buffer->_div();
        $buffer->_div();
    $buffer->_section();

});