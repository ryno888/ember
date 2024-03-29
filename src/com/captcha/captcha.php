<?php

namespace Kwerqy\Ember\com\captcha;

/**
 * @package mod\debug
 * @author Ryno Van Zyl
 */
class captcha extends \Kwerqy\Ember\com\intf\standard {

	//--------------------------------------------------------------------------------
	public static function get_html() {

//	    if(\Kwerqy\Ember\Ember::is_dev()) return "";

	    if(getenv("ember.integrations.google.captcha.sitekey")){
            return \Kwerqy\Ember\com\ui\ui::make()->tag()->script(["@src" => "https://www.google.com/recaptcha/api.js?render=".getenv("ember.integrations.google.captcha.sitekey")]);
        }

	}
    //--------------------------------------------------------------------------------
	public static function is_valid($g_recaptcha_response = false) {

	    if(\Kwerqy\Ember\Ember::is_dev()) return true;

		// params
		if(!$g_recaptcha_response) $g_recaptcha_response = \Kwerqy\Ember\com\request\request::make()->get("g-recaptcha-response");

		if (!$g_recaptcha_response) return false;

		$postdata = http_build_query([
		    "secret"=>getenv("ember.integrations.google.captcha.secret"),
            "response"=>$g_recaptcha_response,
        ]);
        $opts = [
            'http' => [
                'method'  => 'POST',
                'header'  => 'Content-type: application/x-www-form-urlencoded',
                'content' => $postdata
            ]
        ];
        $context  = stream_context_create($opts);
        $result = file_get_contents('https://www.google.com/recaptcha/api/siteverify', false, $context);
        $check = json_decode($result);
        return $check->success;
	}
    //--------------------------------------------------------------------------------
}