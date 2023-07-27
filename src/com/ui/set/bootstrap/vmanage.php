<?php

namespace Kwerqy\Ember\com\ui\set\bootstrap;

/**
 * @package mod\ui\set\system
 * @author Ryno Van Zyl
 */
class vmanage extends \Kwerqy\Ember\com\ui\intf\component {
    
    private $link_arr = [];
    
	//--------------------------------------------------------------------------------
	// magic
	//--------------------------------------------------------------------------------
	protected function __construct($options = []) {
		// init
		$this->name = "Manage Menu";
	}
	//--------------------------------------------------------------------------------
    public function add_link($label, $href, $options = []) {
	    
        $this->link_arr[] = array_merge([
            "label" => $label,
            "link" => $href,
            ".active" => false,
        ], $options);
        
    }
	//--------------------------------------------------------------------------------
    private function get_active_item() {
        foreach ($this->link_arr as $link_data){
            if($link_data[".active"]) return $link_data;
        }

        return reset($this->link_arr);
    }
	//--------------------------------------------------------------------------------
	public function build($options = []) {

		$options = array_merge([
		    "id" => "manage_panel"
		], $options);

		$buffer = \Kwerqy\Ember\com\ui\ui::make()->buffer();

		$buffer->div_([".row py-4" => true]);
            $buffer->div_([".col-auto min-w-200px" => true]);
                $buffer->div_([".list-group list-group-horizontal flex-md-column" => true]);
                    foreach ($this->link_arr as $link_data){
                        $link_data[".list-group-item list-group-item-action border-radius-0"] = true;
                        $link_data["@aria-current"] = $link_data[".active"];
                        $link_data["!click"] = "{$options["id"]}.requestUpdate('{$link_data["link"]}');";
                        $buffer->xlink("javascript:;", $link_data["label"], $link_data);
                    }
                $buffer->_div();

            $buffer->_div();
            $buffer->div_([".col" => true]);
                $active_item = $this->get_active_item();
                if($active_item){
                    $panel = \Kwerqy\Ember\com\ui\ui::make()->panel($active_item["link"], ["id" => $options["id"]]);
                    $buffer->add($panel->build());
                    $buffer->script(["*" => "
                        $(function(){
                            {$panel->get_script()}
                        });
                    "]);
                }
            $buffer->_div();
        $buffer->_div();

		return $buffer->build();

	}
	//--------------------------------------------------------------------------------
}