<?php

\mod\ui::make()->ci_view((empty($controller) ?: $controller), function($buffer, $controller, $view){

    /**
     * @var $buffer \mod\ui\set\system\html
     * @var $controller \mod\ci\controller\controller
     */

    $person = \Kwerqy\Ember\Ember::dbt("person")->get_fromid($controller->per_id);

    display(\mod\db\coder::make());

//    $buffer->build();


}, ["section" => "system", "auth" => "admins"]);