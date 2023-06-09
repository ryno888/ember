<?php

namespace Kwerqy\Ember\com\ui\set\bootstrap;

/**
 * @package mod\ui\set\system
 * @author Ryno Van Zyl
 */
class form extends \Kwerqy\Ember\com\ui\intf\component {
	//--------------------------------------------------------------------------------
	// fields
	//--------------------------------------------------------------------------------
	protected static $is_singleton = true;
	//--------------------------------------------------------------------------------
	// magic
	//--------------------------------------------------------------------------------
	protected function __construct($options = []) {
		// init
		$this->name = "Form";
	}
	//--------------------------------------------------------------------------------
	// functions
	//--------------------------------------------------------------------------------
	public function build($options = []) {
		// public static function form($id, $action = false, $options = []) {

		// options
		$options = array_merge([
			"id" => false,
			"action" => false,

			"@method" => "post",
			"@noserialize" => false,
		], $options);

		// init
		$id = $options["id"];
		$action = $options["action"];

		// id
		$options["@id"] = $id;
		$options["@name"] = $id;

		// action
		$options["@action"] = $action;

		// html
		$html = \Kwerqy\Ember\com\ui\ui::make()->tag()->form_(false, $options);

		// csrf token
		$html .= \Kwerqy\Ember\com\ui\ui::make()->ihidden(csrf_token(), csrf_hash(), ["@noserialize" => "noserialize"]);

		// serialize
		if (!$options["@noserialize"]) {
			\Kwerqy\Ember\com\js\js::add_domready_script("$('#{$id}').data('serialize', $('#{$id}').find('input:not([noserialize], [type=hidden]), select:not([noserialize], [type=hidden]), textarea:not([noserialize], [type=hidden])').serialize());");
		}

  		// done
		return $html;
	}
	//--------------------------------------------------------------------------------
}