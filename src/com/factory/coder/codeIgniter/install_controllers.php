<?php

namespace Kwerqy\Ember\com\factory\coder\codeIgniter;

class install_controllers extends \Kwerqy\Ember\com\intf\standard {

    //--------------------------------------------------------------------------------

	public function build($options = []) {
        $this->install_stream_php();
        $this->install_system_php();
        $this->install_website_php();
        $this->install_dev_php();
	}
	//--------------------------------------------------------------------------------
    private function install_dev_php() {
        $content = <<<EOD
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
    public function xtest() {
        return \Kwerqy\Ember\com\http\http::ajax_response([
            "alert" => "test"]);
    }
    //---------------------------------------------------------------------------------------
}


EOD;

		$filename = DIR_APP."/Controllers/Xdev.php";
		if(file_exists($filename)) return;

		\Kwerqy\Ember\com\os\os::mkdir(dirname($filename));
		file_put_contents($filename, $content);
    }
	//--------------------------------------------------------------------------------
    private function install_website_php() {
        $content = <<<EOD
<?php

namespace App\Controllers;

class Website extends BaseController {
    //---------------------------------------------------------------------------------------
    public function index( \$page) {

        return \Kwerqy\Ember\com\ui\ui::make()->ci_controller("website", "website/index/{\$page}");
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

         \$per_firstname = \Kwerqy\Ember\Ember:: \$request->get('per_firstname', TYPE_STRING);
		 \$per_lastname = \Kwerqy\Ember\Ember:: \$request->get('per_lastname', TYPE_STRING);
		 \$per_email = \Kwerqy\Ember\Ember:: \$request->get('per_email', TYPE_STRING);
		 \$message = \Kwerqy\Ember\Ember:: \$request->get('message', TYPE_TEXT);

		if(!\Kwerqy\Ember\com\data\data::is_valid_email( \$per_email)){
		    return \Kwerqy\Ember\com\http\http::ajax_response(["redirect" => \Kwerqy\Ember\com\http\http::get_error_url(ERROR_CODE_ACCESS_DENIED)]);
        }

         \$email = \Config\Services::email();
         \$email->sendMultipart = false;
         \$email->setMailType("html");

         \$email->setFrom(getenv("ember.email.from"), getenv("ember.name").' - Contact Request');
         \$email->setTo(getenv("ember.email.contact"));

         \$email->setSubject('Contact Request From Website');

         \$buffer = \Kwerqy\Ember\com\ui\ui::make()->buffer();
         \$buffer->p(["*" => "Dear Admin"]);
         \$buffer->p(["*" => "You have received a new contact request from your website."]);
         \$buffer->p(["*" => "Here are the details"]);

         \$buffer->p_();
             \$buffer->string(["*" => "Firstname: "])->span(["*" =>  \$per_firstname])->br();
             \$buffer->string(["*" => "Surname: "])->span(["*" =>  \$per_lastname])->br();
             \$buffer->string(["*" => "Email: "])->span(["*" =>  \$per_email])->br()->br();
             \$buffer->string(["*" => "Message: "])->span(["*" => nl2br( \$message)])->br();
         \$buffer->_p();

         \$buffer->p(["*" => "Kind Regards"]);
         \$buffer->p(["*" => getenv("ember.name"). " Team"]);
         \$email->setMessage( \$buffer->build());

         \$result =  \$email->send();


        return \Kwerqy\Ember\com\http\http::ajax_response(["redirect" => \Kwerqy\Ember\com\http\http::get_message_url(MESSAGE_CODE_100)]);

    }
    //---------------------------------------------------------------------------------------
}



EOD;

		$filename = DIR_APP."/Controllers/Website.php";
		if(file_exists($filename)) return;

		\Kwerqy\Ember\com\os\os::mkdir(dirname($filename));
		file_put_contents($filename, $content);
    }
	//--------------------------------------------------------------------------------
    private function install_system_php() {
        $content = <<<EOD
<?php

namespace App\Controllers;

class System extends BaseController {
    //---------------------------------------------------------------------------------------
    public function index(\$page) {
        return \Kwerqy\Ember\com\ui\ui::make()->ci_controller("system", "system/index/{\$page}");
    }
    //---------------------------------------------------------------------------------------
    public function person(\$page) {
        return \Kwerqy\Ember\com\ui\ui::make()->ci_controller("system", "system/person/{\$page}");
    }
    //---------------------------------------------------------------------------------------
    public function error() {

        return \Kwerqy\Ember\com\ui\ui::make()->ci_controller("system", "system/index/error", [
            "pre_layout" => [
	            "bootstrap/layout/head",
            ],
            "post_layout" => [
                "bootstrap/layout/scripts",
            ],
        ]);
    }
    //---------------------------------------------------------------------------------------
    public function login() {

        if(\Kwerqy\Ember\Ember::\$user->active_user)
            return \Kwerqy\Ember\com\http\http::go_error(ERROR_CODE_ACTIVE_SESSION);

        return \Kwerqy\Ember\com\ui\ui::make()->ci_controller("system", "system/index/login", [
            "pre_layout" => [
	            "system/layout/head",
            ],
            "post_layout" => [
                "system/layout/scripts",
            ],
        ]);
    }
    //---------------------------------------------------------------------------------------
    public function xlogin() {

        \$this->response->setContentType('Content-Type: application/json');

        \$per_username = \Kwerqy\Ember\Ember::\$request->get('per_username', TYPE_STRING);
		\$per_password = \Kwerqy\Ember\Ember::\$request->get('per_password', TYPE_STRING);

		if(!\Kwerqy\Ember\com\http\http::is_valid_form_submit()){
		    return \Kwerqy\Ember\com\http\http::ajax_response(["redirect" => \Kwerqy\Ember\com\http\http::build_action_url("system/error", ["code" => "ERROR_CODE_ACCESS_DENIED"])]);
        }

		if(!\$per_username || !\$per_password)
			return \Kwerqy\Ember\com\http\http::ajax_response(["redirect" => \Kwerqy\Ember\com\http\http::build_action_url("system/error", ["code" => "ERROR_CODE_LOGIN_INVALID_DETAILS"])]);

		\$redirect = \Kwerqy\Ember\com\user\user::make()->login(\$per_username, \$per_password, [
		    "return_url" => true,
            "success_redirect" => \Kwerqy\Ember\com\http\http::build_action_url("system/index/home"),
        ]);
		return \Kwerqy\Ember\com\http\http::ajax_response(["redirect" => \$redirect]);

    }
    //---------------------------------------------------------------------------------------
    public function xlogout() {
        \Kwerqy\Ember\com\user\user::make()->logout();
    }
    //---------------------------------------------------------------------------------------
}


EOD;

		$filename = DIR_APP."/Controllers/System.php";
		if(file_exists($filename)) return;

		\Kwerqy\Ember\com\os\os::mkdir(dirname($filename));
		file_put_contents($filename, $content);
    }
    //--------------------------------------------------------------------------------
    private function install_stream_php() {
        $content = <<<EOD
<?php

namespace App\Controllers;

class Stream extends BaseController {
	//--------------------------------------------------------------------------------
	private function stream_file(\$filename, \$options = []){
		\$options = array_merge([
		    "download" => false,
		    "cache" => true,
		], \$options);

		\Kwerqy\Ember\com\http\http::stream_file(\$filename, \$options);

	}
	//--------------------------------------------------------------------------------
	private function is_download(&\$filename_arr = []){

		\$download = reset(\$filename_arr) == "download";
		if(\$download) array_shift(\$filename_arr);

		return \$download;
	}
	//--------------------------------------------------------------------------------
	public function xasset(...\$filename_arr) {

	    \$this->response->setContentType('Content-Type: application/json');

		\$options = [];
		\$options["download"] = \$this->is_download(\$filename_arr);
		\$this->stream_file(DIR_WRITABLE."/cache/".implode("/", \$filename_arr), \$options);

	}
	//--------------------------------------------------------------------------------
	public function xstream(...\$filename_arr) {

	    \$this->response->setContentType('Content-Type: application/json');

	    \$id = reset(\$filename_arr);

	    \$filename = \Kwerqy\Ember\com\str\str::decrypt_url_r(\$id);

		\$options = [];
		\$options["download"] = \$this->is_download(\$filename_arr);
		\$this->stream_file(\$filename, \$options);
	}
	//--------------------------------------------------------------------------------
	public function xtemp(...\$filename_arr) {

	    \$this->response->setContentType('Content-Type: application/json');

		\Kwerqy\Ember\com\http\http::stream_file(DIR_TEMP."/".implode("/", \$filename_arr));
	}
	//--------------------------------------------------------------------------------
}

EOD;

		$filename = DIR_APP."/Controllers/Stream.php";
		if(file_exists($filename)) return;

		\Kwerqy\Ember\com\os\os::mkdir(dirname($filename));
		file_put_contents($filename, $content);
    }
    //--------------------------------------------------------------------------------

}