<?php

namespace Kwerqy\Ember\com\session;

/**
 * @package mod\debug
 * @author Ryno Van Zyl
 */
class session extends \Kwerqy\Ember\com\intf\standard {

    /**
	 * @var \CodeIgniter\Session\Session
	 */
	public $session;

	//--------------------------------------------------------------------------------
	protected function __construct($options = []) {

		$this->session = session();

	}
	//--------------------------------------------------------------------------------
    public function get($key, $options = []) {

	    $options = array_merge([
	        "default" => false,
	        "datatype" => false,
	    ], $options);

        $value = $this->session->get($key);

        if(\Kwerqy\Ember\isnull($value))
            return $options["default"];

        if($options["datatype"]) 
            $value = \Kwerqy\Ember\com\data\data::parse($value, $options["datatype"]);
        
        return $value;
    }
	//--------------------------------------------------------------------------------
    public function set($data, $value = null) {
        $this->session->set($data, $value);
    }
	//--------------------------------------------------------------------------------
    public function destroy() {
        $this->session->destroy();
    }
	//--------------------------------------------------------------------------------
    public function remove($key) {
        $this->session->remove($key);
    }
	//--------------------------------------------------------------------------------
    public function __call(string $name, array $arguments) {

        return call_user_func_array([$this->session, $name], $arguments);

    }
    //--------------------------------------------------------------------------------
}