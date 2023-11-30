<?php

namespace Kwerqy\Ember\com\ui;

class helper extends \Kwerqy\Ember\com\intf\standard {

	/**
	 * @var bool | \Kwerqy\Ember\com\ui\set\bootstrap\html
	 */
	public static $current_form = false;

	//--------------------------------------------------------------------------------
	public static function evaluate_required_fields($options = []) {
		$error_arr = [];

		$form_id = \Kwerqy\Ember\Ember::$request->get("form_id", TYPE_STRING);
		if($form_id){
			$required_field_arr = \Kwerqy\Ember\Ember::$request->get("__required_field_arr", TYPE_STRING, ["default" => []]);

			if(isset($required_field_arr[$form_id])){
				foreach ($required_field_arr[$form_id] as $required_field => $required_label){
					$value = \Kwerqy\Ember\Ember::$request->get($required_field);
					if (\Kwerqy\Ember\isempty($value)) $error_arr[$required_field] = $required_label." is required";
				}
			}
		}

		return $error_arr;
	}
	//--------------------------------------------------------------------------------
}
