<?php

namespace Kwerqy\Ember\com\ui\set\bootstrap;

/**
 * @package app\ui\set\bootstrap
 * @author Ryno Van Zyl
 * @copyright Copyright Liquid Edge Solutions. All rights reserved.
 */
class icounter extends \Kwerqy\Ember\com\ui\intf\component {
	//--------------------------------------------------------------------------------
	// magic
	//--------------------------------------------------------------------------------
	protected function __construct() {
		$this->name = "Number Counter";
	}
	//--------------------------------------------------------------------------------
	// functions
	//--------------------------------------------------------------------------------
	public function build($options = []) {
		// options
		$options = array_merge([
			"id" => false,
			"value" => 1,
			"min" => 0,
			"max" => null,
			"!change" => false,
			"!down" => false,
			"!leave" => false,
			"!keyup" => false,
			"/input" => [],
			"/btn" => [],
			"disabled" => true,
			"color" => "primary",
			"required_skipval" => false,
			"required" => false,
			"label" => false,

			"wrapper_id" => \Kwerqy\Ember\com\str\str::generate_id(),
		], $options);

		$wrapper_id = $options["wrapper_id"];
		$min = $options["min"];
		$max = $options["max"];
		$value = $options["value"];
		$input_id = \Kwerqy\Ember\com\str\str::generate_id($options["id"]);

		if($min > 0 && $value < $min) $value = $min;

		$buffer = \Kwerqy\Ember\com\ui\ui::make()->buffer();

		$buffer->style("*
			.invalid-feedback[data-target]{
				display:block;
			}
		");

		$wrapper_options["@id"] = $wrapper_id;
		$wrapper_options[".qty-input"] = true;

		$buffer->div_($wrapper_options);
			$buffer->span_(array_merge([".minus btn btn-{$options["color"]}" => true], $options["/btn"]));
				$buffer->xicon("fa-minus", [".mr-2" => false]);
			$buffer->_span();

			$options["/input"]["@value"] = $value;
			$options["/input"]["@type"] = "number";
			$options["/input"][".count"] = true;
			$options["/input"]["@id"] = $input_id;
			$options["/input"]["@name"] = $input_id;

			$buffer->xihidden($options["id"], $value);
			$buffer->input($options["/input"]);

			$buffer->span_(array_merge([".plus btn btn-{$options["color"]}" => true], $options["/btn"]));
				$buffer->xicon("fa-plus", [".mr-2" => false]);
			$buffer->_span();

		$buffer->_div();

		$buffer->div([".invalid-feedback" => true, "@data-target" => $input_id]);

		// required
		if (!$options["required_skipval"]) {
//			if ($options["required"] && \com\ui\helper::$current_form) {
//				\com\ui\helper::$current_form->add_validation_zero($input_id, $options["label"]);
//			}
		}

		$js_id = \Kwerqy\Ember\com\js\js::parse_id($options["id"]);

		\Kwerqy\Ember\com\js\js::add_script("
			
			var {$input_id} = {
				plus:function(){
					let val = parseInt($('#{$wrapper_id} .count').val()) + 1;
					let max = ".(is_null($max) ? 0 : $max).";
					
					if (max > 0 && val >= max)  val = max;
					
				    $('#{$wrapper_id} .count').val(val);
					$('#{$js_id}').val(val);
				},
				minus:function(){
					let val = parseInt($('#{$wrapper_id} .count').val()) - 1;
					if (val <= $min)  val = $min;
					
					$('#{$wrapper_id} .count').val(val);
					$('#{$js_id}').val(val);
				},
				change:function(e){
					let val = parseInt($('#{$input_id}').val());
					let min = parseInt($min);
					let max = parseInt($max);
					
					if (val <= min && e.type.toString() == 'focusout') {
					 	val = min;
						$('#{$input_id}').val(val);
					}
					
					if (max > 0 && val > max && e.type.toString() == 'focusout') {
					 	val = max;
						$('#{$input_id}').val(val);
					}
					
					$('#{$js_id}').val(val);
					
					setTimeout(function(){
						{$options["!change"]}
					}, 20);
				}
			};
		
			$(document).ready(function(){
				
				var min = parseInt($min);
				var intervalId = 0;
				var timeoutId = 0;

				$('body').on('click', '#{$input_id}', function(){
				   $(this).select();
				});
				$('body').on('keyup', '#{$input_id}', function(){
				   {$options["!change"]}
				});

				$('body').on('mousedown', '#{$wrapper_id} .plus', function(){
					timeoutId = setTimeout(function(){ 
						{$options["!down"]}
						 intervalId = setInterval(function(){
							{$input_id}.plus();
						}, 70);
					}, 200);
				}).on('mouseup mouseleave', function() {
					clearTimeout(timeoutId);
					clearTimeout(intervalId);
				});
				
				$('body').on('mousedown', '#{$wrapper_id} .minus', function(){
					timeoutId = setTimeout(function(){ 
						{$options["!down"]}
						 intervalId = setInterval(function(){
							{$input_id}.minus();
						}, 70);
					}, 200);
				}).on('mouseup mouseleave', function() {
					clearTimeout(timeoutId);
				});
			
				$('body').on('keyup', '#{$input_id}', function(e){
					e.preventDefault();
					e.stopPropagation();
					{$input_id}.change(e);
				});
				
				$('body').on('click', '#{$wrapper_id} .plus', function(e){
				
					e.preventDefault();
					e.stopPropagation();
				
					{$input_id}.plus();
				    {$input_id}.change(e);
				});
				
				$('body').on('click', '#{$wrapper_id} .minus', function(e){
				
					e.preventDefault();
					e.stopPropagation();
				
					{$input_id}.minus();
					{$input_id}.change(e);
					
				});
				
				".($options["disabled"] ? "$('#{$input_id}').prop('disabled', true);" : "")."
				
			});
		");


		return $buffer->get_clean();
	}
	//--------------------------------------------------------------------------------
}