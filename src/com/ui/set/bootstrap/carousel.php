<?php

namespace Kwerqy\Ember\com\ui\set\bootstrap;

/**
 * @package app\ui\set\bootstrap
 * @author Ryno Van Zyl
 * @copyright Copyright Liquid Edge Solutions. All rights reserved.
 */
class carousel extends \Kwerqy\Ember\com\intf\standard {

	protected $item_arr = [];

	//--------------------------------------------------------------------------------
	// magic
	//--------------------------------------------------------------------------------
	protected function __construct($options = []) {
		// init
		$this->name = "Carousel";
	}
	//--------------------------------------------------------------------------------
	// functions
	//--------------------------------------------------------------------------------
	public function add_item($src, $options = []) {
		$this->item_arr[] = array_merge([
			"html" => false,
		    "@src" => $src,
		    "caption" => false,
		    "caption_body" => false,
		], $options);
	}
	//--------------------------------------------------------------------------------
	public function add_html($html, $options = []) {

		if(is_callable($html)) $html = $html();

		$this->item_arr[] = array_merge([
		    "@src" => false,
		    "html" => $html,
		    "caption" => false,
		    "caption_body" => false,
		], $options);
	}
	//--------------------------------------------------------------------------------
	public function build($options = []) {
		// options
		$options = array_merge([
			"@id" => strtolower(\Kwerqy\Ember\com\str\str::get_random_alpha()),
			".carousel" => true,
			".slide" => true,
			".carousel-fade" => false,
			"@data-ride" => "carousel",
			"/carousel_inner" => [],

			"/indicators" => [".d-none d-md-flex" => true],
			"/indicators_li" => [],
			"enable_indicators" => true,

			"/control" => [],
			"enable_controls" => true,
  		], $options);

		if(!$this->item_arr) return "";

		$first_index = \Kwerqy\Ember\com\arr\arr::get_first_index($this->item_arr);
		$buffer = \Kwerqy\Ember\com\ui\ui::make()->buffer();


		$buffer->div_($options);
			if($options["enable_indicators"] && sizeof($this->item_arr) > 1){
				$buffer->ol_(array_merge([".carousel-indicators" => true, ], $options["/indicators"]));
					foreach ($this->item_arr as $key => $item){

					    $item_options = array_merge([
					        "@data-target" => "#{$options["@id"]}",
                            "@data-slide-to" => $key,
                            ".active" => $first_index == $key,
                        ], $options["/indicators_li"]);

						$buffer->li($item_options);
					}
				$buffer->_ol();
			}

			$buffer->div_(array_merge([".carousel-inner" => true], $options["/carousel_inner"]));

				$fn_add_item = function($item, $count) use(&$buffer, $first_index){

					$item = array_merge([
					    ".d-block" => true,
						"@alt" => "Slide {$count}"
					], $item);

					if($item["@src"] || $item["html"]){
						$buffer->div_([".carousel-item" => true, ".active" => $first_index == $count]);

							if($item["html"]){
								$buffer->add($item["html"]);
							}else{
								$buffer->div_([".carousel-caption d-block" => true, "#z-index"=>0]);
									if($item["caption"]) $buffer->h5(["*" => $item["caption"]]);
									if($item["caption_body"]) {
										$content_body = is_callable($item["caption_body"]) ? $item["caption_body"]() : $item["caption_body"];
										$buffer->add($content_body);
									}
								$buffer->_div();
								$buffer->img($item);
							}
						$buffer->_div();
					}
				};

				foreach ($this->item_arr as $key => $item){
					$fn_add_item($item, $key);
				}
			$buffer->_div();

			if(sizeof($this->item_arr) > 1 && $options["enable_controls"]){
				$buffer->a_(array_merge([".carousel-control-prev" => true, "@href" => "javascript:$('#{$options["@id"]}').carousel('prev')", "@role" => "button", "@data-slide" => "prev"], $options["/control"]));
					$buffer->xicon("fa-chevron-left", ["@aria-hidden" => "true"]);
					$buffer->span_([".sr-only" => true, ]);
						$buffer->add("Previous");
					$buffer->_span();
				$buffer->_a();

				$buffer->a_(array_merge([".carousel-control-next" => true, "@href" => "javascript:$('#{$options["@id"]}').carousel('next')", "@role" => "button", "@data-slide" => "next"], $options["/control"]));
                    $buffer->xicon("fa-chevron-right", ["@aria-hidden" => "true"]);
					$buffer->span_([".sr-only" => true, ]);
						$buffer->add("Next");
					$buffer->_span();
				$buffer->_a();
			}
		$buffer->_div();

		return $buffer->build();

	}
	//--------------------------------------------------------------------------------
}