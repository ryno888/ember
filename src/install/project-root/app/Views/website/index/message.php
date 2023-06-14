<?php

\Kwerqy\Ember\com\ui\ui::make()->ci_view((empty($controller) ?: $controller), function($buffer, $controller, $view){

    if(!$controller->code) $controller->code = ERROR_CODE_500;

    $buffer->add(\Kwerqy\Ember\com\factory\page_meta\page_meta::make()->build());

    $error_class = \Kwerqy\Ember\com\solid_classes\helper::make()->get_from_constant($controller->code);

    $buffer->div_([".mh-80 d-flex flex-row align-items-center" => true, ]);
		$buffer->div_([".container" => true, ]);
			$buffer->div_([".row justify-content-center" => true, ]);
				$buffer->div_([".col-md-12 text-center" => true, ]);
					$buffer->span([".display-5 d-block" => true, "*" => $error_class->get_display_name()]);
					$buffer->div([".mb-4 lead" => true, "*" => $error_class->get_description()]);

					switch ($error_class->get_value()){
                        default: $buffer->xlink(\Kwerqy\Ember\com\http\http::build_action_url("website/index/home"), "Back to Home", [".btn btn-primary" => true]);
                    }

				$buffer->_div();
			$buffer->_div();
		$buffer->_div();
	$buffer->_div();



});