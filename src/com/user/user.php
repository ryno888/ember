<?php

namespace Kwerqy\Ember\com\user;

/**
 * @package mod\debug
 * @author Ryno Van Zyl
 * svg library https://undraw.co/
 */
class user extends \Kwerqy\Ember\com\intf\standard {

	/**
	 * @var \db\person
	 */
	public $active_user = false;
	
	public $active_id = false;
	public $active_role = false;

	//--------------------------------------------------------------------------------
	public function __construct($options = []) {

		$this->init_active_user($options);
	}

	//--------------------------------------------------------------------------------
	public function init_active_user($options = []) {

		$options = array_merge([
		    "user" => false
		], $options);

		if(!$options["user"]){
			$this->active_user = \Kwerqy\Ember\Ember::$session->get("active_user");
			$this->active_id = \Kwerqy\Ember\Ember::$session->get("active_id");
            $this->active_role =\Kwerqy\Ember\Ember::$session->get("active_role");
		}else{
			$this->active_user = $options["user"];
			$this->active_id = $this->active_user->id;
			$this->active_role = $this->active_user->get_highest_role();

			\Kwerqy\Ember\Ember::$session->set("active_user", $this->active_user);
			\Kwerqy\Ember\Ember::$session->set("active_id", $this->active_id);
			\Kwerqy\Ember\Ember::$session->set("active_role", $this->active_role);
		}


		\Kwerqy\Ember\Ember::$user = &$this;

		return $this->active_user;
	}
	//--------------------------------------------------------------------------------
	/**
	 * @param $username
	 * @param $password
	 * @param array $options
	 * @return array|\db\person|db\row|intf\standard|string
	 */
	public function login($username, $password, $options = []) {
		$options = array_merge([
		    "return_url" => false,
		    "success_redirect" => \Kwerqy\Ember\com\http\http::build_action_url("website/index/home"),
		], $options);

		if($this->active_user)
			return \Kwerqy\Ember\com\http\http::go_error(ERROR_CODE_ACTIVE_SESSION, $options);

		//authenticate
		$authenticated = self::authenticate($username, $password);

		if(!$authenticated)
			return \Kwerqy\Ember\com\http\http::go_error(ERROR_CODE_LOGIN_INVALID, $options);

		//check inactive
		if($authenticated->per_is_active == 0)
			return \Kwerqy\Ember\com\http\http::go_error(ERROR_CODE_ACCOUNT_INACTIVE, $options);

		$this->init_active_user(["user" => $authenticated]);

		//create user session
        if($options["return_url"]) return $options["success_redirect"];

		return \Kwerqy\Ember\com\http\http::redirect($options["success_redirect"]);
	}
	//--------------------------------------------------------------------------------
	/**
	 * @param array $options
	 * @return string
	 */
	public function logout($options = []) {
		$options = array_merge([
		    "return_url" => false,
		    "redirect" => "system/login"
		], $options);

		if(!$this->active_user){
		    if($options["return_url"]) return $options["redirect"];
			return \Kwerqy\Ember\com\http\http::redirect($options["redirect"]);
        }

		$this->active_role = false;
		$this->active_user = false;
		$this->active_role = false;

		\Kwerqy\Ember\Ember::$session->destroy();

		//create user session
        if($options["return_url"]) return $options["redirect"];
		return \Kwerqy\Ember\com\http\http::redirect($options["redirect"]);
	}
	//--------------------------------------------------------------------------------
	/**
	 * @param $username
	 * @param $password
	 * @param array $options
	 * @return array|false|db\row|intf\standard|\db\person
	 */
	public static function authenticate($username, $password, $options = []) {
		$options = array_merge([
		], $options);

		try{
			$person = \Kwerqy\Ember\Ember::dbt("person")->find([
				".per_username" => $username,
			]);

			if (password_verify($password, $person->per_password)) {
				return $person;
			}

		}catch(\Exception $ex){}

		return null;
	}
	//--------------------------------------------------------------------------------
}