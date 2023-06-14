<?php

namespace App\Controllers;

class Website extends BaseController {
    //---------------------------------------------------------------------------------------
    public function index($page) {

        return \Kwerqy\Ember\com\ui\ui::make()->ci_controller("bootstrap", "website/index/{$page}");
    }
    //---------------------------------------------------------------------------------------
    public function contact() {
        return \Kwerqy\Ember\com\ui\ui::make()->ci_controller("bootstrap", "website/index/contact");
    }
    //---------------------------------------------------------------------------------------
    public function vtest() {

        return \Kwerqy\Ember\com\ui\ui::make()->ci_controller("bootstrap", "website/index/vtest");
    }
    //---------------------------------------------------------------------------------------
    public function message() {

        return \Kwerqy\Ember\com\ui\ui::make()->ci_controller("bootstrap", "website/index/message");
    }
    //---------------------------------------------------------------------------------------
    public function newsletter_signup() {

        return \Kwerqy\Ember\com\ui\ui::make()->ci_controller("website", "website/index/newsletter_signup", [
            "pre_layout" => [],
            "post_layout" => [],
        ]);
    }
    //---------------------------------------------------------------------------------------
    public function xnewsletter_signup() {

		if(!\Kwerqy\Ember\com\http\http::is_valid_form_submit()){
		    return \Kwerqy\Ember\com\http\http::ajax_response(["redirect" => \Kwerqy\Ember\com\http\http::get_error_url(ERROR_CODE_ACCESS_DENIED)]);
        }

        $per_firstname = \Kwerqy\Ember\Ember::$request->get('per_firstname', TYPE_STRING);
		$per_lastname = \Kwerqy\Ember\Ember::$request->get('per_lastname', TYPE_STRING);
		$per_email = \Kwerqy\Ember\Ember::$request->get('per_email', TYPE_STRING);

		if(!\Kwerqy\Ember\com\data\data::is_valid_email($per_email)){
		    return \Kwerqy\Ember\com\http\http::ajax_response(["alert" => "Email address is not a valid email."]);
        }

        $mailchimp = \app\app\mailchimp::make();
        $mailchimp->add_contact($per_firstname, $per_lastname, $per_email);

		$buffer = \Kwerqy\Ember\com\ui\ui::make()->buffer();
		$buffer->div_([".d-flex align-items-center" => true]);
		    $buffer->xicon("fa-check", [".text-success fs-4 mr-2" => true]);
		    $buffer->xheader(4, "Thank you for subscribing", false, [".m-0" => true]);
		$buffer->_div();

        return \Kwerqy\Ember\com\http\http::ajax_response([
            "js" => "
                $('.modal-body.mh-40').removeClass('mh-40').addClass('mh-100px d-flex align-items-center');
                $('.signup-wrapper').html('{$buffer->build()}');
            "
        ]);
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


        $email->fromName = "PatriotRSA - System";
        $email->fromEmail = "admin@patriotrsa.co.za";


        $email->setFrom('admin@patriotrsa.co.za', 'PatriotRSA - System - Contact Request');
        $email->setTo('admin@patriotrsa.co.za');
//        $email->setTo('ryno@liquidedge.co.za');

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
        $buffer->p(["*" => "PatriotRSA Team"]);
        $email->setMessage($buffer->build());

        $result = $email->send();


        return \Kwerqy\Ember\com\http\http::ajax_response(["redirect" => \Kwerqy\Ember\com\http\http::get_message_url(MESSAGE_CODE_100)]);

    }
    //---------------------------------------------------------------------------------------
}
