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

        $per_firstname = \Kwerqy\Ember\Ember::$request->get('per_firstname', TYPE_STRING);
		$per_lastname = \Kwerqy\Ember\Ember::$request->get('per_lastname', TYPE_STRING);
		$per_email = \Kwerqy\Ember\Ember::$request->get('per_email', TYPE_STRING);
		$message = \Kwerqy\Ember\Ember::$request->get('message', TYPE_TEXT);

		if(!\Kwerqy\Ember\com\data\data::is_valid_email($per_email)){
		    return \Kwerqy\Ember\com\http\http::ajax_response(["redirect" => \Kwerqy\Ember\com\http\http::get_error_url(ERROR_CODE_ACCESS_DENIED)]);
        }

        $email = \Config\Services::email();
        $email->sendMultipart = false;
        $email->setMailType("html");

        $email->setFrom(getenv("ember.email.from"), getenv("ember.name").' - Contact Request');
        $email->setTo(getenv("ember.email.contact"));

        $email->setSubject('Contact Request From Website');

        $buffer = \Kwerqy\Ember\com\ui\ui::make()->buffer();
        $buffer->p(["*" => "Dear Admin"]);
        $buffer->p(["*" => "You have received a new contact request from your website."]);
        $buffer->p(["*" => "Here are the details"]);

        $buffer->p_();
            $buffer->string(["*" => "Firstname: "])->span(["*" => $per_firstname])->br();
            $buffer->string(["*" => "Surname: "])->span(["*" => $per_lastname])->br();
            $buffer->string(["*" => "Email: "])->span(["*" => $per_email])->br()->br();
            $buffer->string(["*" => "Message: "])->span(["*" => nl2br($message)])->br();
        $buffer->_p();

        $buffer->p(["*" => "Kind Regards"]);
        $buffer->p(["*" => getenv("ember.name"). " Team"]);
        $email->setMessage($buffer->build());

        $result = $email->send();


        return \Kwerqy\Ember\com\http\http::ajax_response(["redirect" => \Kwerqy\Ember\com\http\http::get_message_url(MESSAGE_CODE_100)]);

    }
    //---------------------------------------------------------------------------------------
}
