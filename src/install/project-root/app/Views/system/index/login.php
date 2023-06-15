<?php

\Kwerqy\Ember\com\ui\ui::make()->ci_view((empty($controller) ?: $controller), function($buffer, $controller, $view){

    /**
     * @var $buffer \Kwerqy\Ember\com\ui\set\bootstrap\html
     * @var $controller \Kwerqy\Ember\com\ci\controller\controller
     * @var $view \Kwerqy\Ember\com\ci\view\view
     */

    $buffer->div_([".mh-100 d-flex flex-row align-items-center" => true, ]);
		$buffer->div_([".container" => true, ]);

			$buffer->div_([".row justify-content-center" => true, ]);
				$buffer->div_([".col-md-6 col-xl-4" => true, ]);
					$buffer->div_([".card" => true, ]);
						$buffer->div_([".card-body text-center d-flex flex-column align-items-center" => true, ]);
							$buffer->ximage(\Kwerqy\Ember\com\http\http::get_stream_url(\Kwerqy\Ember\com\asset\asset::get_logo_filename()), [".img-fluid mw-100px mb-2" => true]);
						    $buffer->div([".mb-4 lead fs-7" => true, "*" => "ADMIN PORTAL"]);

							if(\Kwerqy\Ember\com\db\db::is_enabled()){
                                $buffer->form(\Kwerqy\Ember\com\http\http::build_action_url("system/xlogin"));
                                $buffer->xitext("per_username", false, false, ["@placeholder" => "Username", ".mb-3" => true]);
                                $buffer->xitext("per_password", false, false, ["@placeholder" => "Password", ".mb-3" => true, "mask" => true]);
                                $buffer->submit_button(["label" => "Login", ".w-100 mb-2" => true]);

                                $buffer->p_([".text-muted" => true, ]);
                                    $buffer->add("Forgot your password?");
                                $buffer->_p();
                                $buffer->_form();
                            }else{
							    $buffer->p_([".text-muted" => true, ]);
                                    $buffer->add("DB not enabled");
                                $buffer->_p();
                            }
						$buffer->_div();
					$buffer->_div();
				$buffer->_div();
			$buffer->_div();

		$buffer->_div();
	$buffer->_div();

});