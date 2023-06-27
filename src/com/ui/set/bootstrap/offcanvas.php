<?php

namespace Kwerqy\Ember\com\ui\set\bootstrap;

/**
 * @package mod\ui\set\system
 * @author Ryno Van Zyl
 */
class offcanvas extends \Kwerqy\Ember\com\ui\intf\component {

    protected $options = [];
    protected $heading = [];
    protected $body = [];

	//--------------------------------------------------------------------------------
	// magic
	//--------------------------------------------------------------------------------
	protected function __construct($options = []) {
		// init
		$this->options = $options;
		$this->name = "Offcanvas";
		$this->id = \Kwerqy\Ember\com\str\str::generate_id();
	}
	//--------------------------------------------------------------------------------
    public function set_heading($type, $title, $options = []) {

        if(!is_string($title) && is_callable($title)){
		    $title = $title();
        }

        $this->heading = array_merge([
            "type" => $type,
            "title" => $title,
        ], $options);

    }
	//--------------------------------------------------------------------------------
    public function set_body($html, $options = []) {

        if(!is_string($html) && is_callable($html)){
		    $html = $html();
        }

        $this->body = array_merge([
            "*" => $html,
        ], $options);

    }
	//--------------------------------------------------------------------------------
	public function build($options = []) {

		$options = array_merge([
		    "/offcanvas-header" => [],
		    "/offcanvas-body" => [],
		], $options, $this->options);

		$buffer = \Kwerqy\Ember\com\ui\ui::make()->buffer();

		$buffer->div_([".offcanvas offcanvas-end" => true, "@tabindex" => "-1", "@id" => $this->id, "@aria-labelledby" => "{$this->id}Label", ]);

		    $options["/offcanvas-header"][".offcanvas-header"] = true;
            $buffer->div_($options["/offcanvas-header"]);
                if($this->heading){
                    $buffer->xheader($this->heading["type"], $this->heading["title"], false, $this->heading);
                }
                $buffer->button(["@type" => "button", ".btn-close text-reset" => true, "@data-bs-dismiss" => "offcanvas", "@aria-label" => "Close", ]);
            $buffer->_div();

            $buffer->div_([".offcanvas-body" => true, ]);
                $buffer->div($this->body);
            $buffer->_div();
        $buffer->_div();

		return $buffer->build();

	}
	//--------------------------------------------------------------------------------
}