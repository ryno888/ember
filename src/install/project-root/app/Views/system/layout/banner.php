<?php
\Kwerqy\Ember\com\ui\ui::make()->ci_view((empty($controller) ?: $controller), function($buffer, $controller, $view){

    $buffer->xloader();

    $buffer->section_([".banner-wrapper bg-dark" => true, ]);
        $buffer->div_([".container" => true, ]);
            $buffer->div_([".row py-3" => true, ]);
                $buffer->div_([".col text-center" => true, ]);
                    $buffer->span_([".text-white" => true, ]);
                        $buffer->add("Welcome to ".getenv("ember.name"));
                    $buffer->_span();
                $buffer->_div();
            $buffer->_div();
        $buffer->_div();
    $buffer->_section();

});