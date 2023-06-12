<?php

namespace Kwerqy\Ember\com\ui\set\bootstrap;

/**
 * @package mod\ui\set\system
 * @author Ryno Van Zyl
 */
class loader extends \Kwerqy\Ember\com\ui\intf\component {

	//--------------------------------------------------------------------------------
	// magic
	//--------------------------------------------------------------------------------
	protected function __construct($options = []) {
		// init
		$this->name = "Loader";
	}
	//--------------------------------------------------------------------------------
	// functions
	//--------------------------------------------------------------------------------
    public function build($options = []) {

        $options["@id"] = \Kwerqy\Ember\com\str\str::generate_id();
        $options[".page-loader-inner"] = true;

        $buffer = \Kwerqy\Ember\com\ui\ui::make()->buffer();
        $buffer->style(["*" => "
        	.page-loader-overlay {
				left: 0;
				top: 0;
				width: 100%;
				height: 100%;
				position: fixed;
				background: rgb(41 41 41 / 76%);
				z-index: 9999;
			}
			
			.page-loader-inner {
				left: 0;
				top: 0;
				width: 100%;
				height: 100%;
				position: absolute;
			}
			
			.page-loader-content {
				left: 50%;
				position: absolute;
				top: 50%;
				transform: translate(-50%, -50%);
			}
			
			.page-loader-spinner {
				width: 75px;
				height: 75px;
				display: inline-block;
				border-width: 2px;
				border-color: rgba(255, 255, 255, 0.05);
				border-top-color: #fff;
				animation: page_loader_spin 1s infinite linear;
				border-radius: 100%;
				border-style: solid;
			}
			
			@keyframes page_loader_spin {
			  100% {
				transform: rotate(360deg);
			  }
			}
        "]);

        $buffer->div_([".page-loader-overlay" => true]);
			$buffer->div_([".page-loader-inner" => true]);
				$buffer->div_([".page-loader-content" => true]);
					$buffer->span([".page-loader-spinner" => true]);
				$buffer->_div();
			$buffer->_div();
        $buffer->_div();

        \Kwerqy\Ember\com\js\js::add_script("app.overlay.hide();");

        return $buffer->get_clean();
    }
	//--------------------------------------------------------------------------------
}