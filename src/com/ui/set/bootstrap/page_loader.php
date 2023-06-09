<?php

namespace Kwerqy\Ember\com\ui\set\bootstrap;

/**
 * @package mod\ui\set\system
 * @author Ryno Van Zyl
 */
class page_loader extends \Kwerqy\Ember\com\ui\intf\component {

	//--------------------------------------------------------------------------------
	// magic
	//--------------------------------------------------------------------------------
	protected function __construct($options = []) {
		// init
		$this->name = "Page Loader";
	}
	//--------------------------------------------------------------------------------
	public function build($options = []) {

		$options = array_merge([
			"wrapper_id" => "loader",
			"overlay-color" => "rgba(27, 27, 27, 0.7)",
			"loader-color" => "#ffffff",
			"width" => 64,
			"height" => 64,
			"size" => false,
		], $options);

        if($options["size"] !== false){
			$options["width"] = $options["size"];
			$options["size"] = $options["size"];
		}

		$calc = $options["height"] / 2;

        $buffer = \Kwerqy\Ember\com\ui\ui::make()->buffer();
        $buffer->style(["*" => "
            .pageLoader{ display:inline-block; text-align:center; }
			.pageLoader::before{ content:''; display:inline-block; height: calc(50% - {$calc}px); vertical-align:middle; width:0px; }
			.lds-roller { display: inline-block; position: relative; width: {$options["width"]}px; height: {$options["height"]}px; }
			  .lds-roller div { animation: lds-roller 1.2s cubic-bezier(0.5, 0, 0.5, 1) infinite; transform-origin: {$calc}px {$calc}px; }
			  .lds-roller div:after { content: ' '; display: block; position: absolute; width: 6px; height: 6px; border-radius: 50%; background: {$options["loader-color"]}; margin: -3px 0 0 -3px; }
			  .lds-roller div:nth-child(1) { animation-delay: -0.036s; }
			  .lds-roller div:nth-child(1):after { top: 50px; left: 50px; }
			  .lds-roller div:nth-child(2) { animation-delay: -0.072s; }
			  .lds-roller div:nth-child(2):after { top: 54px; left: 45px; }
			  .lds-roller div:nth-child(3) { animation-delay: -0.108s; }
			  .lds-roller div:nth-child(3):after { top: 57px; left: 39px; }
			  .lds-roller div:nth-child(4) { animation-delay: -0.144s; }
			  .lds-roller div:nth-child(4):after { top: 58px; left: 32px; }
			  .lds-roller div:nth-child(5) { animation-delay: -0.18s; }
			  .lds-roller div:nth-child(5):after { top: 57px; left: 25px; }
			  .lds-roller div:nth-child(6) { animation-delay: -0.216s; }
			  .lds-roller div:nth-child(6):after { top: 54px; left: 19px; }
			  .lds-roller div:nth-child(7) { animation-delay: -0.252s; }
			  .lds-roller div:nth-child(7):after { top: 50px; left: 14px; }
			  .lds-roller div:nth-child(8) { animation-delay: -0.288s; }
			  .lds-roller div:nth-child(8):after { top: 45px; left: 10px; }
			  .pageLoader{ display: block; background: {$options["overlay-color"]}; opacity: 0.9; height: 100%; width: 100%; left: 0; top: 0; position: fixed; z-index: 99999;}
			  @keyframes lds-roller {
				0% { transform: rotate(0deg); }
				100% { transform: rotate(360deg); }
			  }
        
        "]);

        $buffer->div_([".pageLoader" => true, "@id" => $options["wrapper_id"]]);
            $buffer->div_([".lds-wrapper" => true]);
                $buffer->div_([".lds-roller" => true]);
                    for ($i = 1; $i <= 8; $i++) {
                        $buffer->div();
                    }
                $buffer->_div();
            $buffer->_div();
        $buffer->_div();

        \mod\js::add_script("
            $(function(){
                app.overlay.hide();
            });
        ");

		return $buffer->build();

	}
	//--------------------------------------------------------------------------------
}