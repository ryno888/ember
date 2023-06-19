<?php

namespace App\Controllers;

class Xdev extends BaseController {

    //---------------------------------------------------------------------------------------
    public function vbuffer_builder() {
        return  \Kwerqy\Ember\com\ui\ui::make()->ci_controller("bootstrap", "xdev/vbuffer_builder");
    }
    //---------------------------------------------------------------------------------------
    public function vtest() {
        return  \Kwerqy\Ember\com\ui\ui::make()->ci_controller("bootstrap", "xdev/vtest");
    }
    //---------------------------------------------------------------------------------------
    public function vinstall() {
        return  \Kwerqy\Ember\com\ui\ui::make()->ci_controller("bootstrap", "xdev/vinstall");
    }
    //---------------------------------------------------------------------------------------
    public function xtest() {
        return \Kwerqy\Ember\com\http\http::ajax_response([
            "alert" => "test"]);
    }
    //---------------------------------------------------------------------------------------
}
