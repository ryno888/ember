<?php

namespace App\Controllers;

class Website extends BaseController {
    //---------------------------------------------------------------------------------------
    public function index($page) {

        return \Kwerqy\Ember\com\ui\ui::make()->ci_controller("website", "website/index/{$page}");
    }
    //---------------------------------------------------------------------------------------
    public function message() {

        return \Kwerqy\Ember\com\ui\ui::make()->ci_controller("website", "website/index/message");
    }
    //---------------------------------------------------------------------------------------
    public function error() {

        return \Kwerqy\Ember\com\ui\ui::make()->ci_controller("website", "website/index/error");
    }
    //---------------------------------------------------------------------------------------
    public function xcontact() {

        if(!\Kwerqy\Ember\com\captcha\captcha::is_valid()){
            return \Kwerqy\Ember\com\http\http::ajax_response(["redirect" => \Kwerqy\Ember\com\http\http::get_error_url(ERROR_CODE_CAPTCHA_ERROR)]);
        }

        if(!\Kwerqy\Ember\com\http\http::is_valid_form_submit()){
		    return \Kwerqy\Ember\com\http\http::ajax_response(["redirect" => \Kwerqy\Ember\com\http\http::get_error_url(ERROR_CODE_ACCESS_DENIED)]);
        }

         $per_firstname = \Kwerqy\Ember\Ember:: $request->get('per_firstname', TYPE_STRING);
		 $per_lastname = \Kwerqy\Ember\Ember:: $request->get('per_lastname', TYPE_STRING);
		 $per_email = \Kwerqy\Ember\Ember:: $request->get('per_email', TYPE_STRING);
		 $message = \Kwerqy\Ember\Ember:: $request->get('message', TYPE_TEXT);

		 $error_arr = [];
		 if(!$per_firstname) $error_arr["per_firstname"] = "Name is required";
		 if(!$per_lastname) $error_arr["per_lastname"] = "Surname is required";
		 if(!$per_email) $error_arr["per_email"] = "Email is required";
		 if(!$message) $error_arr["message"] = "";

		 if($error_arr) return \Kwerqy\Ember\com\http\http::ajax_response(["errors" => $error_arr]);

		if(!\Kwerqy\Ember\com\data\data::is_valid_email( $per_email)){
		    return \Kwerqy\Ember\com\http\http::ajax_response(["redirect" => \Kwerqy\Ember\com\http\http::get_error_url(ERROR_CODE_ACCESS_DENIED)]);
        }

		$email = \Kwerqy\Ember\com\email\email::make();
        $email->set_to(getenv("ember.email.contact"));
        $email->set_from(getenv("ember.email.from"), getenv("ember.name").' - Contact Request');
        $email->set_subject("Contact Request From Website");

        $email->set_body(function()use($per_firstname, $per_lastname, $per_email, $message){
            $buffer = \Kwerqy\Ember\com\ui\ui::make()->buffer();
            $buffer->p(["*" => "Dear Admin"]);
            $buffer->p(["*" => "You have received a new contact request from your website."]);
            $buffer->p(["*" => "Here are the details"]);

            $buffer->p_();
                $buffer->strong(["*" => "Firstname: "])->span(["*" =>  $per_firstname, ".comment" => true])->br();
                $buffer->strong(["*" => "Surname: "])->span(["*" =>  $per_lastname, ".comment" => true])->br();
                $buffer->strong(["*" => "Email: "])->span(["*" =>  $per_email, ".comment" => true])->br()->br();
                $buffer->strong(["*" => "Message: "])->span(["*" => nl2br( $message), ".comment" => true])->br();
            $buffer->_p();

            $buffer->p(["*" => "Kind Regards", "#margin" => "0px"]);
            $buffer->strong(["*" => getenv("ember.name"). " Team"]);

            return $buffer->build();
        });
        $email->send();

        return \Kwerqy\Ember\com\http\http::ajax_response(["redirect" => \Kwerqy\Ember\com\http\http::get_message_url(MESSAGE_CODE_100)]);

    }
    //---------------------------------------------------------------------------------------
}


