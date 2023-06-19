<?php
namespace Kwerqy\Ember;

include_once "com/incl/constants.php";

class Ember {
    /**
	 * @var \Config\App
	 */
	public static $app;

	/**
	 * @var \Kwerqy\Ember\com\session\session
	 */
	public static $session;

    /**
     * @var \Kwerqy\Ember\com\user\user
     */
	public static $user;

	public static $panel;

    /**
     * @var com\request\request
     */
	public static $request;
	public static $content_security_policy_arr = [
        "frame-ancestors" => ["none"],
        "frame-src" => [
           "https://*.google.com/",
           "https://*.youtube.com/",
           "https://www.youtube-nocookie.com/",
           "https://www.googletagmanager.com/"
        ],
        "default-src" => [
            "'self'",
            "https://*.google.com/recaptcha/",
            "https://*.googleapis.com/",
            "https://*.gstatic.com",
            "https://maxcdn.bootstrapcdn.com/",
            "https://*.google.com/",
            "https://*.youtube.com/",
            "https://*.google.com/recaptcha/",
            "https://embed-fastly.wistia.com/",
            "https://distillery.wistia.com/",
            "https://code.jquery.com/",
            "https://app.mobicredwidget.co.za/",
            "https://www.googletagmanager.com/",
            "https://www.google-analytics.com",
            "patriotrsa.us9.list-manage.com",
            "https://cdnjs.cloudflare.com/",
            "data:",
            "blob:",
            "self:",
        ],
        "script-src" => [
            "'unsafe-inline'",
            "'unsafe-eval'",
            "https://*.gstatic.com",
            "https://*.bootstrapcdn.com",
            "https://*.googleapis.com/",
            "https://*.jquery.com",
            "https://www.google.com/js/th/",
            "https://maxcdn.bootstrapcdn.com/",
            "https://code.jquery.com/",
            "https://*.google.com/recaptcha/",
            "https://fast.wistia.com/",
            "https://code.jquery.com/",
            "https://cdn.rawgit.com/",
            "https://cdn.jsdelivr.net/",
            "https://www.youtube.com/",
            "https://app.mobicredwidget.co.za/",
            "https://www.googletagmanager.com/",
            "https://www.google-analytics.com",
            "https://cdnjs.cloudflare.com",
            "https://cdn.jsdelivr.net",
            "chimpstatic.com",
            "downloads.mailchimp.com",
            "mc.us9.list-manage.com",
            "unpkg.com",
            "blob:",
            "self:",
        ],
        "style-src" => [
            "'unsafe-inline'",
            "https://*.googleapis.com/",
            "https://*.jquery.com",
            "https://maxcdn.bootstrapcdn.com/",
            "https://fonts.googleapis.com/",
            "https://cdn.jsdelivr.net",
            "https://cdnjs.cloudflare.com/",
            "downloads.mailchimp.com",
            "unpkg.com",
        ],
        "img-src" => [
            "*.zopim.com/",
            "https://cdn.bootstrapstudio.io/",
            "https://*.googleapis.com/",
            "https://*.jquery.com",
            "https://*.gstatic.com",
            "https://fast.wistia.com",
            "https://embed-fastly.wistia.com/",
            "https://app.mobicredwidget.co.za/",
            "downloads.mailchimp.com",
            "data:",
            "blob:",
            "self:",
        ],
    ];
    //--------------------------------------------------------------------------------

    /**
     * @param $table
     * @param array $options
     * @return mixed|\Kwerqy\Ember\com\db\intf\table|\Kwerqy\Ember\com\db\row
     */
	public static function dbt($table, $options= []) {

	    include_once(DIR_APP."/Libraries/db/{$table}.php");
		$class = "\\db\\{$table}";
		return new $class($options);

	}
    //--------------------------------------------------------------------------------
	public static function db() {
		return \Kwerqy\Ember\com\db\db::make();
	}
	//--------------------------------------------------------------------------------
    /**
     * @return bool
     */
	public static function is_live() {
		return getenv("CI_ENVIRONMENT") == "production";
	}
	//--------------------------------------------------------------------------------
    /**
     * @return bool
     */
	public static function is_test() {
		return getenv("CI_ENVIRONMENT") == "testing";
	}
	//--------------------------------------------------------------------------------
    /**
     * @return bool
     */
	public static function is_dev() {
		return getenv("CI_ENVIRONMENT") == "development";
	}
    //--------------------------------------------------------------------------------
    /**
     * @return bool
     */
	public static function is_installed() {
		return file_exists(DIR_ROOT.".kwerqy_install_log");
	}
    //--------------------------------------------------------------------------------
    /**
     * @return bool
     */
	public static function set_installed() {
		file_put_contents(DIR_ROOT.".kwerqy_install_log", Kwerqy\Ember\com\date\date::strtodatetime());
	}
    //--------------------------------------------------------------------------------
	public static function init() {

	    //autoload helpers
		helper(['text', 'form', 'number', 'security', 'filesystem']);

		self::$app = config('App');

		// shutdown handler
		register_shutdown_function(["Kwerqy\Ember\Ember", "close"]);

		//load constants
//		if(file_exists(DIR_EMBER."/solid_classes/mod.solid_classes.constants.php")){
//			include_once DIR_EMBER."/solid_classes/mod.solid_classes.constants.php";
//		}

		//methods
		function _console($mixed){ \Kwerqy\Ember\com\debug\debug::console($mixed); }
		function _view($mixed, $show_detail = false){ \Kwerqy\Ember\com\debug\debug::view($mixed, ["show_detail" => $show_detail]); }
		function dbvalue($value, $options = []) { return \Kwerqy\Ember\com\db\db::dbvalue($value, $options); }

        function isnull($value) {
		    if(is_null($value) || $value === "null") return true;
            return false;
        }
		function isempty($value) {
		    if(\Kwerqy\Ember\isnull($value)) return true;
		    if(empty($value)) return true;
		    if($value === false || $value === "false") return true;
            return false;
        }

//		self::$session = session();
		self::$session = \Kwerqy\Ember\com\session\session::make();
		self::$user = \Kwerqy\Ember\com\user\user::make();
		self::$request = \Kwerqy\Ember\com\request\request::make();
		self::$panel = self::$request->get_get("p", TYPE_STRING, ["default" => "mod"]);
//
//
//		\app\app::make()->install();
//
//
		header(\Kwerqy\Ember\com\http\http::get_content_security_policy(self::$content_security_policy_arr));

	}
	//--------------------------------------------------------------------------------
    public static function console($mixed, $options = []){ \Kwerqy\Ember\com\debug\debug::console($mixed, $options); }
    public static function display($mixed, $show_detail = false){ \Kwerqy\Ember\com\debug\debug::view($mixed, ["show_detail" => $show_detail]); }
    public static function dbvalue($value, $options = []) { return \Kwerqy\Ember\com\db\db::dbvalue($value, $options); }
	//--------------------------------------------------------------------------------
	public static function get_env($name, $options = []) {
	    $options = array_merge([
	        "datatype" => TYPE_STRING,
	        "default" => false,
	    ], $options);

	    $value = getenv($name);

	    if(!$value) return $options["default"];

//		return \mod\data::parse($value, $options["datatype"]);
	}
	//--------------------------------------------------------------------------------
	public static function close() {

		// display more information on fatal errors
//		$error = error_get_last();
//		$fatal_error_arr = [E_ERROR, E_PARSE, E_CORE_ERROR, E_COMPILE_ERROR];
//		if ($error && isset($error["type"]) && in_array($error["type"], $fatal_error_arr)) {
//			// build message
//			$message = "Fatal error: {$error["message"]} in {$error["file"]} on line {$error["line"]}";
//
//			// trigger fatal error
//			\Kwerqy\Ember\com\error\error::create($message, ["fatal" => true]);
//		}
	}
    //--------------------------------------------------------------------------------

    /**
     * @return com\intf\standard|com\ui\ui
     */
    public static function ui() {

        return com\ui\ui::make();
    }
    //--------------------------------------------------------------------------------

    /**
     * @param $name
     * @return false|mixed|\Kwerqy\Ember\com\intf\section
     */
    public static function get_section($name) {
        return call_user_func(["\\Kwerqy\\Ember\\com\\factory\\section\\{$name}", "make"]);
    }
    //--------------------------------------------------------------------------------
	public static function auth_check($token) {
        return true;
//		$auth = call_user_func(["\\app\\acc\\auth\\{$token}", "make"]);
//
//	    return $auth->check(\core::$user->active_role);
	}
	//--------------------------------------------------------------------------------
	/**
	 * @return false|string
	 */
	public static function get_environment() {
		return isset($_SERVER['CI_ENVIRONMENT']) ? $_SERVER['CI_ENVIRONMENT'] : null;
	}
	//--------------------------------------------------------------------------------
    /**
     * @return bool
     */
	public static function is_db_enabled() {
		return (bool) self::get_env("database.default.hostname");
	}
    //--------------------------------------------------------------------------------
}