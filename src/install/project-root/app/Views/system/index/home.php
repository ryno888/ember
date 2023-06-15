<?php

\Kwerqy\Ember\com\ui\ui::make()->ci_view((empty($controller) ?: $controller), function($buffer, $controller, $view){

    /**
     * @var $buffer \Kwerqy\Ember\com\ui\set\bootstrap\html
     * @var $controller \Kwerqy\Ember\com\ci\controller\controller
     * @var $view \Kwerqy\Ember\com\ci\view\view
     */
    
    $buffer->form(current_url());
    $buffer->div_([".container mh-100vh" => true]);
        $buffer->xheader(1, "timmy");
        $buffer->xitext("test1", false, "test");
        $buffer->xitext("test2");

        $buffer->xiradio("iradio", ["1" => "yes", "2" => "no"], false, "Test");
        $buffer->xiswitch("xiswitch", false, "Test");

        $buffer->xmessage("This is a standard message");
        $buffer->xmessage("This is a standard message", "secondary");
        $buffer->xmessage("This is a standard message", "info", ["dismissible" => true]);

        $buffer->div_([".mb-2" => true]);
            $buffer->xbadge("This is a standard message", "info", [".mr-2" => true]);
            $buffer->xbadge("This is a standard message", "primary", [".mr-2" => true]);
            $buffer->xbadge("This is a standard message", "success", [".mr-2" => true]);
        $buffer->_div();

        $buffer->div_();
            $breadcrumb = \mod\ui::make()->breadcrumb();
            $breadcrumb->add_item("link 1", "#");
            $breadcrumb->add_item("link 2", "#");
            $breadcrumb->add_item("Current");
            $buffer->add($breadcrumb->build());
        $buffer->_div();

        $buffer->div_();
            $accordion = \mod\ui::make()->accordion();
            $accordion->add_item("link 1", function() {

                $buffer = \mod\ui::make()->buffer();
                $buffer->div_([".p-2" => true]);
                    $buffer->p(["*" => "Suspendisse eu ligula. Nunc sed turpis. Sed lectus. Nulla porta dolor."]);
                    $buffer->p(["*" => "Vivamus laoreet. Phasellus viverra nulla ut metus varius laoreet. Aliquam erat volutpat. Nulla porta dolor."]);
                    $buffer->p(["*" => "Praesent vestibulum dapibus nibh. Morbi vestibulum volutpat enim. Pellentesque ut neque. Fusce neque."]);
                $buffer->_div();
                return $buffer->build();
            });
            $accordion->add_item("link 2", "dfsdsfds");
            $buffer->add($accordion->build());
        $buffer->_div();

        $buffer->submit_button();



        $buffer->xdropzone("temp", DIR_TEMP."/dropzone", ["crop" => true]);



    $buffer->_div();
    
});
