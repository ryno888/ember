<?php

namespace Kwerqy\Ember\com\ui\set\bootstrap;

/**
 * @package mod\ui\set\system
 * @author Ryno Van Zyl
 */
class accordion extends \Kwerqy\Ember\com\ui\intf\component {
	//--------------------------------------------------------------------------------
	// fields
	//--------------------------------------------------------------------------------
    /**
     * @var array
     */
    protected $item_arr = [];

	protected static $is_singleton = true;
	//--------------------------------------------------------------------------------
	// magic
	//--------------------------------------------------------------------------------
	protected function __construct($options = []) {
		// init
		$this->name = "Accordion";
	}
	//--------------------------------------------------------------------------------
	// functions
	//--------------------------------------------------------------------------------
    public function add_item($heading, $content = false, $options = []) {
        $this->item_arr[] = array_merge([
            "heading" => $heading,
            "content" => $content,
            "/" => [],
        ], $options);
    }
	//--------------------------------------------------------------------------------
	public function build($options = []) {
		// options
		$options = array_merge([
		    "@id" => \Kwerqy\Ember\com\str\str::generate_id(["prepend" => "accordion"]),
		    ".accordion" => true,
		], $options);

		$buffer = \Kwerqy\Ember\com\ui\ui::make()->buffer();

        $buffer->div_($options);
            foreach ($this->item_arr as $index => $item){
                $id_heading = "{$options["@id"]}_{$index}_heading";
                $id_collapse = "{$options["@id"]}_{$index}_collapse";

                $card = \Kwerqy\Ember\com\ui\ui::make()->card(false, false, array_merge([
                    "/card" => [],
                    "/title" => [],
                    "/sub_title" => [],
                    "/card_header" => [".card-header" => true, "@id" => $id_heading, "*" => function() use($id_heading, $id_collapse, $item){
                        $buffer = \Kwerqy\Ember\com\ui\ui::make()->buffer();
                        $buffer->h2_([".mb-0" => true, ]);
                            $buffer->xbutton($item["heading"], false, [
                                "@data-toggle" => "collapse",
                                "@class" => "btn btn-link",
                                "@data-target" => "#{$id_collapse}",
                                "@aria-expanded" => "false",
                                "@aria-controls" => $id_collapse
                            ]);
                        $buffer->_h2();
                        return $buffer->build();
                    }],
                    "/card_body" => ["@id" => $id_collapse, ".collapse" => true, "@aria-labelledby" => $id_heading, "@data-parent" => "#{$options["@id"]}", "*" => $item["content"]],
                ], $item));

                $buffer->add($card);
            }
        $buffer->_div();

        return $buffer->build();



	}
	//--------------------------------------------------------------------------------
}