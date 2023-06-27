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
    public function vview_error() {
        return \Kwerqy\Ember\com\ui\ui::make()->ci_controller("bootstrap", "xdev/vview_error", [
	        "pre_layout" => [
	            "bootstrap/layout/head",
            ],
            "post_layout" => [
                "bootstrap/layout/scripts",
            ],
        ]);

    }
    //--------------------------------------------------------------------------------
	public function xclear_debug() {

	    //set POST data
		$close_window = \Kwerqy\Ember\Ember::$request->get("close_window", TYPE_BOOL);

		if(file_exists(DIR_TEMP."/console.txt")){
			@unlink(DIR_TEMP."/console.txt");
		}

		$options["js"] = "$('.debug-wrapper').remove();";
		if($close_window) $options["js"] = "window.top.close();";

		return \Kwerqy\Ember\com\http\http::ajax_response($options);
	}
    //---------------------------------------------------------------------------------------
    public function xtest() {
        return \Kwerqy\Ember\com\http\http::ajax_response([
            "alert" => "test"]);
    }
    //---------------------------------------------------------------------------------------
}
