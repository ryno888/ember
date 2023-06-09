<?php

namespace Kwerqy\Ember\com\ui\set\bootstrap;

/**
 * @package mod\ui\set\system
 * @author Ryno Van Zyl
 */
class dropzone extends \Kwerqy\Ember\com\ui\intf\component {

	//--------------------------------------------------------------------------------
	// magic
	//--------------------------------------------------------------------------------
	protected function __construct($options = []) {
		// init
		$this->name = "Dropzone";
	}
	//--------------------------------------------------------------------------------
	public function build($options = []) {
	    $dropzone = \mod\incl\dropzone\dropzone::make();
	    return $dropzone->build($options);
	}
	//--------------------------------------------------------------------------------
}