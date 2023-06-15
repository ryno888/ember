<?php

\mod\ui::make()->ci_view((empty($controller) ?: $controller), function($buffer, $controller, $view){

    $table = \mod\ui::make()->table();
    $table->set_key("per_id");
    $table->set_search_field(\mod\db::getsql_concat(["per_firstname", "per_email"]));
    $table->set_sql(\Kwerqy\Ember\com\db\sql\select::make()
        ->select("per_id AS id")
        ->select("person.*")
        ->from("person")
    );

    $table->add_field("Name", "per_firstname", ["function" => function($content, $item_index, $field_index, $list){
        return $content ? $content : "-";
    }]);
    $table->add_field("Email", "per_email");

    $table->add_action_link("Edit", \mod\http::build_action_url(["system", "person", "vedit"], ["per_id" => "%per_id%"]));
    $table->add_action("Delete", "alert(1)", [".btn-danger" => true, ".btn-light" => false]);
    $table->add_action_dropdown(function($item_data, $dropdown, $table){
        $dropdown->add_button("Edit", "alert(1)", ["icon" => "fa-edit"]);
        $dropdown->add_button("Delete", "alert(1)", ["icon" => "fa-trash"]);
        $dropdown->add_link("#", "test 2");
    });

    if($table->is_stream())
        return $table->stream_json_data();

    $buffer->div_([".container-fluid" => true]);
        $buffer->div_([".row" => true]);
            $buffer->div_([".col-12" => true]);
                $buffer->add("Timmy");
                $table->build($buffer);
            $buffer->_div();
        $buffer->_div();
    $buffer->_div();


}, ["section" => "system", "auth" => "admins"]);