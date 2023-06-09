<?php

namespace Kwerqy\Ember\com\ui\set\bootstrap;

/**
 * @package mod\ui\set\system
 * @author Ryno Van Zyl
 */
class breadcrumb extends \Kwerqy\Ember\com\ui\intf\component {

    /**
     * @var array
     */
    protected $item_arr = [];

	//--------------------------------------------------------------------------------
	// magic
	//--------------------------------------------------------------------------------
	protected function __construct($options = []) {
		// init
		$this->name = "Breadcrumb";
	}
	//--------------------------------------------------------------------------------
    public function add_item($label, $link = false, $options = []) {
        $this->item_arr[] = array_merge([
            "label" => $label,
            "link" => $link,
            "/" => [],
        ], $options);
    }
	//--------------------------------------------------------------------------------
	public function build($options = []) {

		$options = array_merge([
		], $options);


		$buffer = \Kwerqy\Ember\com\ui\ui::make()->buffer();

		$buffer->nav_(["@aria-label" => "breadcrumb", ]);
            $buffer->ol_([".breadcrumb" => true, ]);
                foreach ($this->item_arr as $item){

                    $item[".breadcrumb-item"] = true;

                    $buffer->li_($item);

                        if($item["link"]){
                            $buffer->xlink($item["link"], $item["label"], $item["/"]);
                        } else {
                            $item["/"] = array_merge([
                                "*" => $item["label"]
                            ], $item["/"]);
                            $buffer->span($item["/"]);
                        }
                    $buffer->_li();
                }
            $buffer->_ol();
        $buffer->_nav();

		return $buffer->build();

	}
	//--------------------------------------------------------------------------------
}