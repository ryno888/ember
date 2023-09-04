<?php

namespace Kwerqy\Ember\com\ui\intf;

/**
 * @package mod\ui\intf
 * @author Ryno Van Zyl
 */
abstract class component extends \Kwerqy\Ember\com\intf\standard{

	protected $id;
	//--------------------------------------------------------------------------------
	protected function __construct($options = []) {
		// init
		$this->id = $this->build_id();
	}
	//--------------------------------------------------------------------------------

	/**
	 * @return string
	 */
	public function build_id($id_parts = []): string {
	    
	    if(!$id_parts){
	        return \Kwerqy\Ember\com\str\str::generate_id(["prefix" => "component"]);
        }
	    
	    $uid = \Kwerqy\Ember\com\str\uid::make();
	    foreach ($id_parts as $id_part) $uid->add_data($id_part);
	    
	    return "component_".$uid->build();
		
	}
	//--------------------------------------------------------------------------------

	/**
	 * @return string
	 */
	public function get_id(): string {
		return $this->id;
	}
	//--------------------------------------------------------------------------------

	/**
	 * @param string $id
	 */
	public function set_id(string $id): void {
		$this->id = $id;
	}
	//--------------------------------------------------------------------------------
	// interface
	//--------------------------------------------------------------------------------
	abstract public function build($options = []);
	//--------------------------------------------------------------------------------
}