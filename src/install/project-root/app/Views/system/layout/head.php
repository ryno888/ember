<?php

\Kwerqy\Ember\com\ui\ui::make()->ci_view((empty($controller) ?: $controller), function($buffer, $controller, $view){

    /**
     * @var $buffer \Kwerqy\Ember\com\ui\set\bootstrap\html
     * @var $controller \Kwerqy\Ember\com\ci\controller\controller
     * @var $view \Kwerqy\Ember\com\ci\view\view
     */
    
    $buffer->head_();
        $buffer->add(\Kwerqy\Ember\com\factory\page_meta\page_meta::make()->build());

        $buffer->link(["@rel" => "shortcut icon", '@type' => 'image/x-icon', '@href' => \Kwerqy\Ember\com\http\http::get_stream_url(\Kwerqy\Ember\com\asset\asset::get_favicon_filename())]);
        $buffer->link(["@rel" => "preconnect", "@href" => "https://fonts.googleapis.com"]);
        $buffer->link(["@rel" => "preconnect", "@href" => "https://fonts.gstatic.com", "@crossorigin" => true]);
        $buffer->link(["@rel" => "stylesheet", "@href" => "https://fonts.googleapis.com/css2?family=Fira+Sans:wght@200;300;400;700&family=Poppins:ital,wght@0,200;0,400;0,600;1,200;1,400;1,600&display=swap"]);

        $assets_builder = \Kwerqy\Ember\com\compiler\assets::make(["section" => "system"]);
        $assets_builder->run();
        $buffer->add($assets_builder->get_stream_css());

        $buffer->script(["@src" => \Kwerqy\Ember\com\http\http::get_stream_url(ROOTPATH."/vendor/components/jquery/jquery.min.js")]);

    $buffer->_head();
    
});