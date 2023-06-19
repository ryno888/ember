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
        
            .page-loader {
                transform: rotateZ(45deg);
                perspective: 1000px;
                border-radius: 50%;
                width: 48px;
                height: 48px;
                color: #fff;
              }
                .page-loader:before,
                .page-loader:after {
                  content: '';
                  display: block;
                  position: absolute;
                  top: 0;
                  left: 0;
                  width: inherit;
                  height: inherit;
                  border-radius: 50%;
                  transform: rotateX(70deg);
                  animation: 1s spin linear infinite;
                }
                .page-loader:after {
                  color: #FF3D00;
                  transform: rotateY(70deg);
                  animation-delay: .4s;
                }
        
              @keyframes rotate {
                0% {
                  transform: translate(-50%, -50%) rotateZ(0deg);
                }
                100% {
                  transform: translate(-50%, -50%) rotateZ(360deg);
                }
              }
        
              @keyframes rotateccw {
                0% {
                  transform: translate(-50%, -50%) rotate(0deg);
                }
                100% {
                  transform: translate(-50%, -50%) rotate(-360deg);
                }
              }
        
              @keyframes spin {
                0%,
                100% {
                  box-shadow: .2em 0px 0 0px currentcolor;
                }
                12% {
                  box-shadow: .2em .2em 0 0 currentcolor;
                }
                25% {
                  box-shadow: 0 .2em 0 0px currentcolor;
                }
                37% {
                  box-shadow: -.2em .2em 0 0 currentcolor;
                }
                50% {
                  box-shadow: -.2em 0 0 0 currentcolor;
                }
                62% {
                  box-shadow: -.2em -.2em 0 0 currentcolor;
                }
                75% {
                  box-shadow: 0px -.2em 0 0 currentcolor;
                }
                87% {
                  box-shadow: .2em -.2em 0 0 currentcolor;
                }
              }
           
        "]);
        $buffer->div_([".page-loader-overlay" => true]);
			$buffer->div_([".page-loader-inner" => true]);
				$buffer->div_([".page-loader-content" => true]);
                    $buffer->div([".page-loader" => true]);
				$buffer->_div();
			$buffer->_div();
        $buffer->_div();

        \Kwerqy\Ember\com\js\js::add_script("app.overlay.hide();");

        return $buffer->get_clean();
    }
	//--------------------------------------------------------------------------------
}