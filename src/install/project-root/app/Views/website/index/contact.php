<?php

\Kwerqy\Ember\com\ui\ui::make()->ci_view((empty($controller) ?: $controller), function($buffer, $controller, $view){

    /**
     * @var $buffer \Kwerqy\Ember\com\ui\set\bootstrap\html
     * @var $controller \Kwerqy\Ember\com\ci\controller\controller
     * @var $view \Kwerqy\Ember\com\ci\view\view
     */

    $buffer->xspace(50);

    $buffer->section_([".py-4 py-xl-5" => true, ]);
        $buffer->div_([".container" => true, ]);

            $buffer->div_([".row mt-5" => true, ]);
                $buffer->div_([".col text-center" => true, ]);
                    $buffer->xheader(1, "Contact Us");
                    $buffer->hr();
                $buffer->_div();
            $buffer->_div();

        $buffer->_div();
    $buffer->_section();

});

