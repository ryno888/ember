<?php

namespace Kwerqy\Ember\com\ui\set\bootstrap;

/**
 * @package mod\ui\set\system
 * @author Ryno Van Zyl
 */
class toast extends \Kwerqy\Ember\com\ui\intf\component {
	//--------------------------------------------------------------------------------
	// magic
	//--------------------------------------------------------------------------------
	protected function __construct($options = []) {
		// init
		$this->name = "Toast";
	}
	//--------------------------------------------------------------------------------
	public function build($options = []) {

		$options = array_merge([

		], $options);


		$buffer = \Kwerqy\Ember\com\ui\ui::make()->buffer();

		$options["/"] = [
		    ".toast" => true,
            "@role" => "alert",
            "@aria-live" => "assertive",
            "@aria-atomic" => "true",
            "@data-autohide" => "false",
            "@data-delay" => "2000",
        ];

		$buffer->div_($options["/"]);
            $buffer->div_([".toast-header" => true, ]);
                $buffer->div([".rounded me-2 p-2" => true, ".bg-primary" => true]);
                $buffer->strong([".me-auto" => true, "*" => "Bootstrap"]);

                $buffer->small([".text-muted" => true, "*" => "2 seconds ago"]);
                $buffer->xbutton("×", false, ["@class" => "ms-2 mb-1 close", "@data-dismiss" => "toast", "@aria-label" => "Close"]);

            $buffer->_div();

            $buffer->div_([".toast-body" => true, ]);
                $buffer->add("Heads up, toasts will stack automatically");
            $buffer->_div();
        $buffer->_div();

		return $buffer->build();

	}
	//--------------------------------------------------------------------------------
}