<?php

namespace Kwerqy\Ember\com\ui\set\bootstrap;

/**
 *
 * https://www.daterangepicker.com/#usage
 *
 * Class scrolltotop
 * @package app\ui\set\bootstrap
 * @author Ryno Van Zyl
 * @copyright Copyright Liquid Edge Solutions. All rights reserved.
 */

class idaterange extends \Kwerqy\Ember\com\ui\intf\component {

    //--------------------------------------------------------------------------------
	// fields
	//--------------------------------------------------------------------------------
	protected static $is_singleton = true;
	//--------------------------------------------------------------------------------
	// magic
	//--------------------------------------------------------------------------------
	protected function __construct($options = []) {
		// init
		$this->name = "Date Range Picker";
	}
	//--------------------------------------------------------------------------------
	// functions
	//--------------------------------------------------------------------------------
    public function build($options = []) {
        $options = array_merge([
            "id" => false,
			"value" => false,
			"value_format" => false,
			"label" => false,

			// basic
			"!change" => false,
			"@disabled" => false,
			"@placeholder" => "yyyy-mm-dd",
			"@data-date-format" => "yyyy-mm-dd",

			// advanced
			"hidden" => false,
			"multifield" => false,
			"singlepicker" => false,
			"autoapply" => true,
			"/field1" => [],
			"/field2" => [],

			// form-input
			"help" => false,
			"required" => false,
			"prepend" => false,
			"append" => false,
			"wrapper_id" => false,
			"label_width" => false,
			"label_col" => false,
			"label_html" => false,

			".ui-idate" => true,
		], $options);

        // init
		$id = $options["id"];
		$startdate = $options["startdate"];
		$enddate = $options["enddate"];
		$label = $options["label"];
		$onchange = '';

		// value
  		if($startdate) $startdate = \Kwerqy\Ember\com\date\date::strtodate($startdate, ($options["value_format"] ?: \Kwerqy\Ember\com\date\date::$DATE_FORMAT), ["default" => \Kwerqy\Ember\com\date\date::strtodate()]);
  		if($enddate) $enddate = \Kwerqy\Ember\com\date\date::strtodate($enddate, ($options["value_format"] ?: \Kwerqy\Ember\com\date\date::$DATE_FORMAT), ["default" => \Kwerqy\Ember\com\date\date::strtodate()]);

        $buffer = \Kwerqy\Ember\com\ui\ui::make()->buffer();
        $options["prepend"] = \Kwerqy\Ember\com\ui\ui::make()->icon("calendar", [".me-2" => false]);
        $options[".$id"] = true;

        $JS_start_id = \Kwerqy\Ember\com\js\js::parse_id("{$id}[startdate]");
        $JS_end_id = \Kwerqy\Ember\com\js\js::parse_id("{$id}[enddate]");
        $JS_id = \Kwerqy\Ember\com\js\js::parse_id($id);

        $options["target"] = "#$JS_id";

        if($options["multifield"]) $this->add_multifield($buffer, $id, $options);
        else $buffer->xitext($id, false, $label, $options);

        $js = [];
        $js[] = "
            $('{$options["target"]}').daterangepicker(".\Kwerqy\Ember\com\js\js::create_options([
                "*autoUpdateInput" => false,
                "*singleDatePicker" => $options["singlepicker"],
                "*autoApply" => $options["autoapply"],
                "*opens" => "center",
                "*minDate" => \Kwerqy\Ember\com\date\date::strtodate(),
                "*locale" => ["format" => "YYYY-MM-DD"],
            ]).", function(start, end, label) {
                $onchange
            });
        ";

        if($startdate) {
            $js[] = "$('{$options["target"]}').data('daterangepicker').setStartDate('$startdate');";
            \Kwerqy\Ember\com\js\js::add_script("$(function(){ setTimeout(function(){ $('#$JS_start_id').val('$startdate'); }, 50) });");
        }
        if($enddate){
            $js[] = "$('{$options["target"]}').data('daterangepicker').setEndDate('$enddate');";
            \Kwerqy\Ember\com\js\js::add_script("$(function(){ setTimeout(function(){ $('#$JS_end_id').val('$enddate'); }, 50) });");
        }

        if($options["multifield"]){
            $js[]= "
                $('{$options["target"]}').on('show.daterangepicker', function(ev, picker) {
                    if($('#$JS_start_id').val().length){
                        picker.setStartDate($('#$JS_start_id').val());
                        $('#$JS_start_id').val(picker.startDate.format('YYYY-MM-DD'));
                    }
                    if($('#$JS_end_id').val().length){
                        picker.setEndDate($('#$JS_end_id').val());
                        $('#$JS_end_id').val(picker.endDate.format('YYYY-MM-DD'));
                    }
                });
                $('{$options["target"]}').on('cancel.daterangepicker', function(ev, picker) {
                    $('#$JS_start_id').val(picker.startDate.format('YYYY-MM-DD'));
                    $('#$JS_end_id').val(picker.endDate.format('YYYY-MM-DD'));
                });
                $('{$options["target"]}').on('apply.daterangepicker', function(ev, picker) {
                    $('#$JS_start_id').val(picker.startDate.format('YYYY-MM-DD'));
                    $('#$JS_end_id').val(picker.endDate.format('YYYY-MM-DD'));
                });
                $('{$options["target"]}').on('hide.daterangepicker', function(ev, picker) {
                    $('#$JS_start_id').val(picker.startDate.format('YYYY-MM-DD'));
                    $('#$JS_end_id').val(picker.endDate.format('YYYY-MM-DD'));
                });
            ";
        }

        \Kwerqy\Ember\com\js\js::add_script("
            $(function(){".implode(" ", $js)."});
        ");

        return $buffer->get_clean();

    }
    //--------------------------------------------------------------------------------
    private function add_multifield(&$buffer, $id, &$options) {

	    $options["target"] = ".$id";
	    $options[".daterange"] = false;
	    $options["@readonly"] = true;
	    $options[".bg-white"] = true;
	    $options["/wrapper"] = [".w-50" => true];

        $buffer->div_([".d-flex $id" => true]);
            $buffer->xitext("{$id}[startdate]", false, false, array_merge($options, $options["/field1"]));
            $buffer->div([".me-2" => true]);
            $buffer->xitext("{$id}[enddate]", false, false, array_merge($options, $options["/field2"]));
        $buffer->_div();
    }
	//--------------------------------------------------------------------------------
}