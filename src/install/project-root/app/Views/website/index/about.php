<?php

\Kwerqy\Ember\com\ui\ui::make()->ci_view((empty($controller) ?: $controller), function($buffer, $controller, $view){

    /**
     * @var $buffer \Kwerqy\Ember\com\ui\set\bootstrap\html
     * @var $controller \Kwerqy\Ember\com\ci\controller\controller
     * @var $view \Kwerqy\Ember\com\ciiewiew
     */

    $buffer->xspace(80);
    $buffer->div_([".container" => true, ]);
		$buffer->div_([".row justify-content-center" => true, ]);
			$buffer->div_([".col-xl-10" => true, ]);
				$buffer->div_([".row mt-5" => true, ]);
					$buffer->div_([".col text-center" => true, ]);
						$buffer->xheader(1, "About Us");
						$buffer->hr();
					$buffer->_div();
				$buffer->_div();
			$buffer->_div();
		$buffer->_div();
	$buffer->_div();

});

