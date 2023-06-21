<?php

namespace Kwerqy\Ember\com\ui\set\bootstrap;

/**
 * @package mod\ui\set\system
 * @author Ryno Van Zyl
 */
class scrolltotop extends \Kwerqy\Ember\com\ui\intf\component {
	//--------------------------------------------------------------------------------
	// fields
	//--------------------------------------------------------------------------------
	protected static $is_singleton = true;
	protected $css = false;
	protected $js = false;
	//--------------------------------------------------------------------------------
	// magic
	//--------------------------------------------------------------------------------
	protected function __construct($options = []) {
		// init
		$this->name = "Scroll to top";
		$this->buffer = \Kwerqy\Ember\com\ui\ui::make()->buffer();
	}
	//--------------------------------------------------------------------------------
    public function apply_css($css = false) {
        if(!$css){
            $this->css = "
                .scroll-to-top {
                    position: fixed;
                    bottom: 20px;
                    right: 30px;
                    z-index: 99;
                    font-size: 18px;
                    border: none;
                    outline: none;
                    padding: 10px;
                }
            ";
        }
    }
	//--------------------------------------------------------------------------------
    public function apply_js($script = false) {
        if(!$script){
            $this->js = "
                $(document).ready(function () {
                    $(window).scroll(function () {
                        if ($(this).scrollTop() > 20) {
                            $('.scroll-to-top').fadeIn();
                        } else {
                            $('.scroll-to-top').fadeOut();
                        }
                    });
                
                    $('body').on('click', '.scroll-to-top', function () {
                        let element = $('.scroll-to-top');
                        $('body').animate({
                            scrollTop: 0
                        }, 50, function() {
                            element.blur().focusout();
                            element.mouseleave();
                        });
                        
                        return false;
                    });
                    
                    setTimeout(function(){
                        $(window).scroll();
                    }, 100);
                });
            ";
        }
    }
	//--------------------------------------------------------------------------------
	// functions
	//--------------------------------------------------------------------------------
    public function build($options = []) {
        $options = array_merge([
            ".btn btn-primary" => true,
            "*" => "Top"
		], $options);

        if(!$this->js) $this->apply_js();
        if(!$this->css) $this->apply_css();

        $this->buffer->style(["*" => $this->css]);
        $this->buffer->script(["*" => $this->js]);

        $this->buffer->div_();
            $options["@type"] = "button";
            $options[".scroll-to-top"] = true;
            $options["#display"] = "none";
            $this->buffer->button($options);
        $this->buffer->_div();

        return $this->buffer->get_clean();
    }
	//--------------------------------------------------------------------------------
}