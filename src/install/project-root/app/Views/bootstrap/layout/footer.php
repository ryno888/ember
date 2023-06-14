<?php
\Kwerqy\Ember\com\ui\ui::make()->ci_view((empty($controller) ?: $controller), function($buffer, $controller, $view){

    $buffer->footer_([".text-white bg-dark" => true, ]);
		$buffer->div_([".container text-center py-4 py-lg-5" => true, ]);
			$buffer->ul_([".list-inline" => true, ]);
				$buffer->li_([".list-inline-item" => true, ]);
					$buffer->a_([".text-white" => true, "@href" => "https://patriotapparel.co.za/", "@target" => "_blank"]);
                        $buffer->add("In Partnership with Patriot Apparel");
					$buffer->_a();
				$buffer->_li();
			$buffer->_ul();
			$buffer->ul_([".list-inline" => true, ]);

			    $fn_social = function($link, $icon)use(&$buffer){
			        $buffer->li_([".list-inline-item" => true, ]);
                        $buffer->a_([".text-white" => true, "@href" => $link, "@target" => "_blank"]);
                            $buffer->xicon($icon);
                        $buffer->_a();
                    $buffer->_li();
                };

			    $fn_social(getenv("ember.website.social.facebook"), "fab-facebook");
			    $fn_social(getenv("ember.website.social.twitter"), "fab-twitter");
			    $fn_social(getenv("ember.website.social.instagram"), "fab-instagram");
			    $fn_social(getenv("ember.website.social.tiktok"), "fab-tiktok");

			$buffer->_ul();
			$buffer->p_([".text-white-50 mb-0" => true, ]);
                $buffer->add("© Patriot RSA 2019. Copyright");
			$buffer->_p();
		$buffer->_div();
	$buffer->_footer();

});