<?php

namespace app\ui\set\bootstrap;

/**
 * @package mod\ui\set\system
 * @author Ryno Van Zyl
 *
 * source
 * https://preview.colorlib.com/#ogani
 *
 */
class product_card extends \Kwerqy\Ember\com\ui\intf\component {

    /**
     * @var \db\product
     */
    protected $product;

	//--------------------------------------------------------------------------------
	// magic
	//--------------------------------------------------------------------------------
	protected function __construct($options = []) {
		// init
		$this->name = "Product Card";
	}
	//--------------------------------------------------------------------------------
	// functions
	//--------------------------------------------------------------------------------
    public function build($options = []) {

	    $options = array_merge([
	        "data" => []
	    ], $options);

	    if(!$options["data"]) return "";

	    $this->product = \core::dbt("product")->get_fromarray($options["data"]);

        $buffer = \Kwerqy\Ember\com\ui\ui::make()->buffer();
        $buffer->div_([".product-card cursor-pointer" => true, "@data-url" => site_url("website/product/details")]);
            $buffer->div_([".product-item-img set-bg zoom zoom-sm" => true, "@data-setbg" => \Kwerqy\Ember\com\http\http::get_stream_url(DIR_ASSETS_FILES."/img/products/test_1.jpeg"), "@style" => "background-image: url('".\Kwerqy\Ember\com\http\http::get_stream_url(DIR_ASSETS_FILES."/img/products/test_1.jpeg")."');", ]);
                $buffer->ul_([".product-item-img-hover" => true, ]);
                    $buffer->li_();
                        $buffer->xlink("#", false, ["icon" => "fa-search"]);
                    $buffer->_li();
                    $buffer->li_();
                        $buffer->xlink("#", false, ["icon" => "fa-heart"]);
                    $buffer->_li();
                    $buffer->li_();
                        $buffer->xlink("#", false, ["icon" => "fa-plus"]);
                    $buffer->_li();
                $buffer->_ul();
            $buffer->_div();
            $buffer->div_([".product-item-text" => true, ]);
                $buffer->xheader(6, $this->product->format_name());
                $buffer->xheader(5, \Kwerqy\Ember\com\num\num::currency($this->product->pro_price));
            $buffer->_div();
        $buffer->_div();

        return $buffer->get_clean();
    }
	//--------------------------------------------------------------------------------
}