<?php

namespace Kwerqy\Ember\com\factory\coder\codeIgniter;

class install_views extends \Kwerqy\Ember\com\intf\standard {

    //--------------------------------------------------------------------------------

	public function build($options = []) {

	    $layout_arr = ["bootstrap", "system", "website"];
	    foreach ($layout_arr as $layout){
	        $this->install_file(DIR_APP."/Views/{$layout}/layout/banner.php", $this->get_template_banner());
            $this->install_file(DIR_APP."/Views/{$layout}/layout/footer.php", $this->get_template_footer());
            $this->install_file(DIR_APP."/Views/{$layout}/layout/head.php", $this->get_template_head());
            $this->install_file(DIR_APP."/Views/{$layout}/layout/navbar.php", $this->get_template_navbar());
            $this->install_file(DIR_APP."/Views/{$layout}/layout/scripts.php", $this->get_template_scripts());
        }

        $this->install_system();
        $this->install_website();
        $this->install_dev();
	}
	//--------------------------------------------------------------------------------
    private function install_system() {
        $this->install_file(DIR_APP."/Views/system/index/home.php", <<<EOD
<?php

\Kwerqy\Ember\com\ui\ui::make()->ci_view((empty(\$controller) ?: \$controller), function(\$buffer, \$controller, \$view){

    /**
     * @var \$buffer \Kwerqy\Ember\com\ui\set\bootstrap\html
     * @var \$controller \Kwerqy\Ember\com\ci\controller\controller
     * @var \$view \Kwerqy\Ember\com\ci\\view\\view
     */
    
});

EOD);
        $this->install_file(DIR_APP."/Views/system/index/error.php", <<<EOD
<?php

\Kwerqy\Ember\com\ui\ui::make()->ci_view((empty(\$controller) ?: \$controller), function(\$buffer, \$controller, \$view){

    /**
     * @var \$buffer \Kwerqy\Ember\com\ui\set\bootstrap\html
     * @var \$controller \Kwerqy\Ember\com\ci\controller\controller
     * @var \$view \Kwerqy\Ember\com\ci\\view\\view
     */
    
    if(!\$controller->code) \$controller->code = ERROR_CODE_500;

    \$error_class = \Kwerqy\Ember\com\solid_classes\helper::make()->get_from_constant(\$controller->code);

    \$buffer->div_([".mh-100 d-flex flex-row align-items-center" => true, ]);
		\$buffer->div_([".container" => true, ]);
			\$buffer->div_([".row justify-content-center" => true, ]);
				\$buffer->div_([".col-md-12 text-center" => true, ]);
					\$buffer->span([".display-5 d-block mb-2" => true, "*" => \$error_class->get_display_name()]);
					\$buffer->div([".mb-4 lead" => true, "*" => \$error_class->get_description()]);

					switch (\$error_class->get_value()){
                        case ERROR_CODE_ACTIVE_SESSION:
                            \$buffer->xlink(\Kwerqy\Ember\com\http\http::build_action_url("system/index/home"), "Go Home", [".btn btn-primary mr-2" => true]);
                            \$buffer->xlink(\Kwerqy\Ember\com\http\http::build_action_url("system/xlogout"), "logout", [".btn btn-secondary" => true]);
                            break;
                        case ERROR_CODE_LOGIN_INVALID_DETAILS:
                        case ERROR_CODE_LOGIN_INVALID:
                            \$buffer->xlink(\Kwerqy\Ember\com\http\http::build_action_url("system/login"), "Try Again", [".btn btn-primary" => true]);
                            break;
                        case ERROR_CODE_ACCESS_DENIED:
                            \$buffer->xlink(\Kwerqy\Ember\com\http\http::build_action_url("system/index/home"), "Try Again", [".btn btn-primary" => true]);
                            break;

                        default: \$buffer->xlink(\Kwerqy\Ember\com\http\http::build_action_url("system/index/home"), "Back to Home", [".btn btn-primary" => true]);
                    }

				\$buffer->_div();
			\$buffer->_div();
		\$buffer->_div();
	\$buffer->_div();
    
});


EOD);
        $this->install_file(DIR_APP."/Views/system/index/login.php", <<<EOD
<?php

\Kwerqy\Ember\com\ui\ui::make()->ci_view((empty(\$controller) ?: \$controller), function(\$buffer, \$controller, \$view){

    /**
     * @var \$buffer \Kwerqy\Ember\com\ui\set\bootstrap\html
     * @var \$controller \Kwerqy\Ember\com\ci\controller\controller
     * @var \$view \Kwerqy\Ember\com\ci\\view\\view
     */

    \$buffer->div_([".mh-100 d-flex flex-row align-items-center" => true, ]);
		\$buffer->div_([".container" => true, ]);

			\$buffer->div_([".row justify-content-center" => true, ]);
				\$buffer->div_([".col-md-6 col-xl-4" => true, ]);
					\$buffer->div_([".card" => true, ]);
						\$buffer->div_([".card-body text-center d-flex flex-column align-items-center" => true, ]);
							\$buffer->ximage(\Kwerqy\Ember\com\http\http::get_stream_url(\Kwerqy\Ember\com\asset\asset::get_logo_filename()), [".img-fluid mw-100px mb-2" => true]);
						    \$buffer->div([".mb-4 lead fs-7" => true, "*" => "ADMIN PORTAL"]);

							if(\Kwerqy\Ember\com\db\db::is_enabled()){
                                \$buffer->form(\Kwerqy\Ember\com\http\http::build_action_url("system/xlogin"));
                                \$buffer->xitext("per_username", false, false, ["@placeholder" => "Username", ".mb-3" => true]);
                                \$buffer->xitext("per_password", false, false, ["@placeholder" => "Password", ".mb-3" => true, "mask" => true]);
                                \$buffer->submit_button(["label" => "Login", ".w-100 mb-2" => true]);

                                \$buffer->p_([".text-muted" => true, ]);
                                    \$buffer->add("Forgot your password?");
                                \$buffer->_p();
                                \$buffer->_form();
                            }else{
							    \$buffer->p_([".text-muted" => true, ]);
                                    \$buffer->add("DB not enabled");
                                \$buffer->_p();
                            }
						\$buffer->_div();
					\$buffer->_div();
				\$buffer->_div();
			\$buffer->_div();

		\$buffer->_div();
	\$buffer->_div();

});

EOD);

    }
    //--------------------------------------------------------------------------------
    private function install_website() {

	    $this->install_file(DIR_APP."/Views/website/index/home.php", <<<EOD
<?php

\Kwerqy\Ember\com\ui\ui::make()->ci_view((empty(\$controller) ?: \$controller), function(\$buffer, \$controller, \$view){

    /**
     * @var \$buffer \Kwerqy\Ember\com\ui\set\bootstrap\html
     * @var \$controller \Kwerqy\Ember\com\ci\controller\controller
     * @var \$view \Kwerqy\Ember\com\ci\view\view
     */

    \$buffer->section_([".py-4 py-xl-5" => true, ]);
        \$buffer->div_([".container" => true]);
            \$buffer->div_([".row" => true]);
                \$buffer->div_([".col" => true]);
                    \$buffer->xheader(1, "Home");
                \$buffer->_div();
            \$buffer->_div();
        \$buffer->_div();
    \$buffer->_section();

});


EOD);
	    $this->install_file(DIR_APP."/Views/website/index/about.php", <<<EOD
<?php

\Kwerqy\Ember\com\ui\ui::make()->ci_view((empty(\$controller) ?: \$controller), function(\$buffer, \$controller, \$view){

    /**
     * @var \$buffer \Kwerqy\Ember\com\ui\set\bootstrap\html
     * @var \$controller \Kwerqy\Ember\com\ci\controller\controller
     * @var \$view \Kwerqy\Ember\com\ci\view\view
     */

    \$buffer->section_([".py-4 py-xl-5" => true, ]);
        \$buffer->div_([".container" => true]);
            \$buffer->div_([".row" => true]);
                \$buffer->div_([".col" => true]);
                    \$buffer->xheader(1, "About");
                \$buffer->_div();
            \$buffer->_div();
        \$buffer->_div();
    \$buffer->_section();

});


EOD);
	    $this->install_file(DIR_APP."/Views/website/index/contact.php", <<<EOD
<?php

\Kwerqy\Ember\com\ui\ui::make()->ci_view((empty(\$controller) ?: \$controller), function(\$buffer, \$controller, \$view){

    /**
     * @var \$buffer \Kwerqy\Ember\com\ui\set\bootstrap\html
     * @var \$controller \Kwerqy\Ember\com\ci\controller\controller
     * @var \$view \Kwerqy\Ember\com\ci\\view\\view
     */

    \$buffer->section_([".py-4 py-xl-5" => true, ]);
        \$buffer->div_([".container" => true]);
            \$buffer->div_([".row" => true]);
                \$buffer->div_([".col" => true]);
                    \$buffer->xheader(1, "Contact");
                \$buffer->_div();
            \$buffer->_div();
        \$buffer->_div();
    \$buffer->_section();

});


EOD);
	    $this->install_file(DIR_APP."/Views/website/index/message.php", <<<EOD
<?php

\Kwerqy\Ember\com\ui\ui::make()->ci_view((empty(\$controller) ?: \$controller), function(\$buffer, \$controller, \$view){

    if(!\$controller->code) \$controller->code = ERROR_CODE_500;

    \$buffer->add(\Kwerqy\Ember\com\factory\page_meta\page_meta::make()->build());

    \$error_class = \Kwerqy\Ember\com\solid_classes\helper::make()->get_from_constant(\$controller->code);

    \$buffer->div_([".mh-80 d-flex flex-row align-items-center" => true, ]);
		\$buffer->div_([".container" => true, ]);
			\$buffer->div_([".row justify-content-center" => true, ]);
				\$buffer->div_([".col-md-12 text-center" => true, ]);
					\$buffer->span([".display-5 d-block" => true, "*" => \$error_class->get_display_name()]);
					\$buffer->div([".mb-4 lead" => true, "*" => \$error_class->get_description()]);

					switch (\$error_class->get_value()){
                        default: \$buffer->xlink(\Kwerqy\Ember\com\http\http::build_action_url("website/index/home"), "Back to Home", [".btn btn-primary" => true]);
                    }

				\$buffer->_div();
			\$buffer->_div();
		\$buffer->_div();
	\$buffer->_div();



});


EOD);
	    $this->install_file(DIR_APP."/Views/website/index/error.php", <<<EOD
<?php

\Kwerqy\Ember\com\ui\ui::make()->ci_view((empty(\$controller) ?: \$controller), function(\$buffer, \$controller, \$view){

    if(!\$controller->code) \$controller->code = ERROR_CODE_500;

    \$buffer->add(\Kwerqy\Ember\com\factory\page_meta\page_meta::make()->build());

    \$error_class = \Kwerqy\Ember\com\solid_classes\helper::make()->get_from_constant(\$controller->code);

    \$buffer->div_([".mh-65 d-flex flex-row align-items-center" => true, ]);
		\$buffer->div_([".container" => true, ]);
			\$buffer->div_([".row justify-content-center" => true, ]);
				\$buffer->div_([".col-md-12 text-center" => true, ]);
					\$buffer->span([".display-5 d-block" => true, "*" => \$error_class->get_display_name()]);
					\$buffer->div([".mb-4 lead" => true, "*" => \$error_class->get_description()]);

					switch (\$error_class->get_value()){
                        case ERROR_CODE_ACTIVE_SESSION:
                            \$buffer->xlink(\Kwerqy\Ember\com\http\http::build_action_url("system/index/home"), "Go Home", [".btn btn-primary mr-2" => true]);
                            \$buffer->xlink(\Kwerqy\Ember\com\http\http::build_action_url("system/xlogout"), "logout", [".btn btn-secondary" => true]);
                            break;
                        case ERROR_CODE_LOGIN_INVALID_DETAILS:
                        case ERROR_CODE_LOGIN_INVALID:
                            \$buffer->xlink(\Kwerqy\Ember\com\http\http::build_action_url("system/login"), "Try Again", [".btn btn-primary" => true]);
                            break;

                        default: \$buffer->xlink(\Kwerqy\Ember\com\http\http::build_action_url("system/login"), "Back to Home", [".btn btn-primary" => true]);
                    }

				\$buffer->_div();
			\$buffer->_div();
		\$buffer->_div();
	\$buffer->_div();



});


EOD);

    }
    //--------------------------------------------------------------------------------
    private function install_dev() {

	    $this->install_file(DIR_APP."/Views/xdev/vbuffer_builder.php", <<<EOD
<?php

\Kwerqy\Ember\com\ui\ui::make()->ci_view((empty(\$controller) ?: \$controller), function(\$buffer, \$controller, \$view){

    /**
     * @var \$buffer \Kwerqy\Ember\com\ui\set\bootstrap\html
     * @var \$controller \Kwerqy\Ember\com\ci\controller\controller
     * @var \$view \Kwerqy\Ember\com\ci\view\view
     */

    \$str = '';

    \$builder = \Kwerqy\Ember\com\factory\buffer_builder\builder::make();
    \$builder->add_html(\$str);

    \$buffer->xitextarea("html", \$builder->build(["wrap" => false]), false, ["rows" => 30]);

});

EOD);
	    $this->install_file(DIR_APP."/Views/xdev/vtest.php", <<<EOD
<?php

\Kwerqy\Ember\com\ui\ui::make()->ci_view((empty(\$controller) ?: \$controller), function(\$buffer, \$controller, \$view){

    /**
     * @var \$buffer \Kwerqy\Ember\com\ui\set\bootstrap\html
     * @var \$controller \Kwerqy\Ember\com\ci\controller\controller
     * @var \$view \Kwerqy\Ember\com\ci\view\view
     */

});

EOD);

    }
	//--------------------------------------------------------------------------------
    public function install_file($filename, $content) {
        if(file_exists($filename)) return;

		\Kwerqy\Ember\com\os\os::mkdir(dirname($filename));
		file_put_contents($filename, $content);
    }
    //--------------------------------------------------------------------------------
    public function get_template_scripts() {
        return <<<EOD
<?php

\Kwerqy\Ember\com\ui\ui::make()->ci_view((empty(\$controller) ?: \$controller), function(\$buffer, \$controller, \$view){

    /**
     * @var \$buffer \Kwerqy\Ember\com\ui\set\bootstrap\html
     * @var \$controller \Kwerqy\Ember\com\ci\controller\controller
     * @var \$view \Kwerqy\Ember\com\ci\view\view
     */
    
    \$buffer->add(\Kwerqy\Ember\com\compiler\assets::make(["section" => "system"])->run()->get_stream_js());
    \$buffer->xdebug();
    
});


EOD;
    }
	//--------------------------------------------------------------------------------
    public function get_template_banner() {
        return <<<EOD
<?php
\Kwerqy\Ember\com\ui\ui::make()->ci_view((empty(\$controller) ?: \$controller), function(\$buffer, \$controller, \$view){

    /**
     * @var \$buffer \Kwerqy\Ember\com\ui\set\bootstrap\html
     * @var \$controller \Kwerqy\Ember\com\ci\controller\controller
     * @var \$view \Kwerqy\Ember\com\ci\\view\\view
     */
    
    \$buffer->xloader();

    \$buffer->section_([".banner-wrapper bg-dark" => true, ]);
        \$buffer->div_([".container" => true, ]);
            \$buffer->div_([".row py-3" => true, ]);
                \$buffer->div_([".col text-center" => true, ]);
                    \$buffer->span_([".text-white" => true, ]);
                        \$buffer->add("Welcome to ".getenv("ember.name"));
                    \$buffer->_span();
                \$buffer->_div();
            \$buffer->_div();
        \$buffer->_div();
    \$buffer->_section();
    
});


EOD;
    }
	//--------------------------------------------------------------------------------
    public function get_template_footer() {
        return <<<EOD
<?php

\Kwerqy\Ember\com\ui\ui::make()->ci_view((empty(\$controller) ?: \$controller), function(\$buffer, \$controller, \$view){

    /**
     * @var \$buffer \Kwerqy\Ember\com\ui\set\bootstrap\html
     * @var \$controller \Kwerqy\Ember\com\ci\controller\controller
     * @var \$view \Kwerqy\Ember\com\ci\\view\\view
     */
    
    \$link_arr = [];
    \$link_arr["Home"] = site_url("website/index/home");
    \$link_arr["About"] = site_url("website/index/about");
    \$link_arr["Contact"] = site_url("website/index/contact");

    \$buffer->footer_([".py-3 my-4" => true, ]);
        \$buffer->ul_([".nav justify-content-center border-bottom pb-3 mb-3" => true, ]);
            \$fn_link = function(\$label, \$link)use(&\$buffer){
                \$buffer->li_([".nav-item" => true, ]);
                    \$buffer->xlink(\$link, \$label, [".nav-link px-2 text-muted" => true]);
                \$buffer->_li();
            };
            foreach (\$link_arr as \$label => \$link) \$fn_link(\$label, \$link);
        \$buffer->_ul();
        \$buffer->p_([".text-center text-muted" => true, ]);
            \$buffer->add(\Kwerqy\Ember\Ember::get_copyright());
        \$buffer->_p();
    \$buffer->_footer();
    
});

EOD;
    }
	//--------------------------------------------------------------------------------
    public function get_template_navbar() {
        return <<<EOD
<?php
\Kwerqy\Ember\com\ui\ui::make()->ci_view((empty(\$controller) ?: \$controller), function(\$buffer, \$controller, \$view){

    /**
     * @var \$buffer \Kwerqy\Ember\com\ui\set\bootstrap\html
     * @var \$controller \Kwerqy\Ember\com\ci\controller\controller
     * @var \$view \Kwerqy\Ember\com\ci\\view\\view
     */

    \$link_arr = [];
    \$link_arr["Home"] = site_url("website/index/home");
    \$link_arr["About"] = site_url("website/index/about");
    \$link_arr["Contact"] = site_url("website/index/contact");

    \$buffer->section_();
        \$navbar = \Kwerqy\Ember\com\ui\ui::make()->navbar();
        \$navbar->set_brand_html(function(){
            return \Kwerqy\Ember\com\ui\ui::make()->image(\Kwerqy\Ember\com\http\http::get_stream_url(DIR_ASSETS_IMG."/__logo.png"), [".img-fluid pb-2" => true]);
        });
        foreach (\$link_arr as \$label => \$url) \$navbar->add_item(\$label, \$url);
        \$buffer->add(\$navbar->build());
    \$buffer->_section();
    
});

EOD;
    }
	//--------------------------------------------------------------------------------
    public function get_template_head() {
        return <<<EOD
<?php

\Kwerqy\Ember\com\ui\ui::make()->ci_view((empty(\$controller) ?: \$controller), function(\$buffer, \$controller, \$view){

    /**
     * @var \$buffer \Kwerqy\Ember\com\ui\set\bootstrap\html
     * @var \$controller \Kwerqy\Ember\com\ci\controller\controller
     * @var \$view \Kwerqy\Ember\com\ci\\view\\view
     */
    
    \$buffer->head_();
        \$buffer->add(\\Kwerqy\\Ember\\com\\factory\\page_meta\\page_meta::make()->build());

        \$buffer->link(["@rel" => "shortcut icon", '@type' => 'image/x-icon', '@href' => \Kwerqy\Ember\com\http\http::get_stream_url(\Kwerqy\Ember\com\asset\asset::get_favicon_filename())]);
        \$buffer->link(["@rel" => "preconnect", "@href" => "https://fonts.googleapis.com"]);
        \$buffer->link(["@rel" => "preconnect", "@href" => "https://fonts.gstatic.com", "@crossorigin" => true]);
        \$buffer->link(["@rel" => "stylesheet", "@href" => "https://fonts.googleapis.com/css2?family=Fira+Sans:wght@200;300;400;700&family=Poppins:ital,wght@0,200;0,400;0,600;1,200;1,400;1,600&display=swap"]);

        \$assets_builder = \Kwerqy\Ember\com\compiler\assets::make(["section" => "bootstrap"]);
        \$assets_builder->run();
        \$buffer->add(\$assets_builder->get_stream_css());

        \$buffer->script(["@src" => \Kwerqy\Ember\com\http\http::get_stream_url(ROOTPATH."/vendor/components/jquery/jquery.min.js")]);

    \$buffer->_head();
    
});
EOD;
    }
	//--------------------------------------------------------------------------------

}