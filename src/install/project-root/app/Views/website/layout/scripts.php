<?php

\Kwerqy\Ember\com\ui\ui::make()->ci_view((empty($controller) ?: $controller), function($buffer, $controller, $view){
    $buffer->add(\Kwerqy\Ember\com\compiler\assets::make(["section" => "bootstrap"])->run()->get_stream_js());
    $buffer->xdebug();
});