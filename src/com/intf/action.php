<?php

namespace Kwerqy\Ember\com\intf;

/**
 * @package mod\intf
 * @author Ryno Van Zyl
 */
abstract class action extends standard {

	public $session;

	public $request;

	public $data = [];

	//--------------------------------------------------------------------------------
	protected function __construct($options = []) {

		$this->session = session();
		$this->request = \core::$request;

	}
	//--------------------------------------------------------------------------------

	abstract public function run(&$buffer, $options = []);
	//--------------------------------------------------------------------------------
	public function set_data(array $data) {
		$this->data = $data;
	}
	//--------------------------------------------------------------------------------
	public function __get($name) {

		if(isset($this->data[$name])) return $this->data[$name];

	}
	//--------------------------------------------------------------------------------
}