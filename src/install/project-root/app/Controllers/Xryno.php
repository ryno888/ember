<?php

namespace App\Controllers;

class Xryno extends BaseController {

    //---------------------------------------------------------------------------------------
    public function vtest() {
        return  \Kwerqy\Ember\com\ui\ui::make()->ci_controller("bootstrap", "xryno/vtest");
    }
    //---------------------------------------------------------------------------------------
    public function xtest() {
//        if(!\Kwerqy\Ember\com\http\http::is_valid_form_submit()){
//		    return \Kwerqy\Ember\com\http\http::ajax_response(["redirect" => \Kwerqy\Ember\com\http\http::get_error_url(ERROR_CODE_ACCESS_DENIED)]);
//        }

        return \Kwerqy\Ember\com\http\http::ajax_response([
            "alert" => "test"]);
    }
    //---------------------------------------------------------------------------------------
}
