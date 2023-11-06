<?php

namespace Kwerqy\Ember\com\ui\set\bootstrap;

/**
 * @package mod\ui\set\system
 * @author Ryno Van Zyl
 */
class collapse extends \Kwerqy\Ember\com\ui\intf\component {
	//--------------------------------------------------------------------------------
	// fields
	//--------------------------------------------------------------------------------
	protected $title;
	protected $item_arr = [];
	//--------------------------------------------------------------------------------
	// magic
	//--------------------------------------------------------------------------------
	protected function __construct($options = []) {
		// init
		$this->name = "Collapse";
	}
	//--------------------------------------------------------------------------------
	public function add_link($href, $label, $options = []) {
		$this->item_arr[] = array_merge( [
		    "id" => "link_".sizeof($this->item_arr),
			"label" => $label,
			"@href" => $href,
			"icon" => false,
			"type" => "link",
			".collapse-item" => true,
		], $options);
	}
	//--------------------------------------------------------------------------------
	public function add_divider($options = []) {
		$this->item_arr[] = array_merge( [
		    "id" => "divider_".sizeof($this->item_arr),
			"type" => "divider",
		], $options);
	}
	//--------------------------------------------------------------------------------
	public function add_html($html, $options = []) {
	    
	    if(!is_string($html) && is_callable($html)){
		    $html = $html();
        }
	    
		$this->item_arr[] = array_merge( [
		    "id" => "html_".sizeof($this->item_arr),
			"html" => $html,
			"type" => "html",
		], $options);
	}
	//--------------------------------------------------------------------------------
	public function add_header($size, $title, $options = []) {
		$this->item_arr[] = array_merge([
		    "id" => "header_".sizeof($this->item_arr),
			"size" => $size,
			"title" => $title,
			"type" => "header",
			".collapse-header" => true
		], $options);
	}
	//--------------------------------------------------------------------------------
	/**
	 * @param string $title
	 */
	public function set_title(string $title): void {
		$this->title = $title;
	}
	//--------------------------------------------------------------------------------
    public function build_id($id_parts = []): string {

	    $id_parts = array_column($this->item_arr, "id");
	    $id_parts[] = $this->title;

        return parent::build_id($id_parts);
    }

    //--------------------------------------------------------------------------------
	public function build($options = []) {
		$options = array_merge([
		    "id" => $this->build_id(array_column($this->item_arr, "id")),
		    "title" => $this->title,
		    "icon" => false,
		    "/link" => [],
		    "/collapse_inner" => [
		    	".py-2 rounded" => true,
			],
		], $options);

		$this->id = $options["id"];
		$buffer = \Kwerqy\Ember\com\ui\ui::make()->buffer();

		$buffer->div_([".collapse-wrapper" => true]);

			$link = $options["/link"];
			$link[".nav-link collapsed"] = true;
			$link["@data-bs-target"] = "#{$this->id}";
			$link["@aria-bs-controls"] = $this->id;
			$link["@href"] = "#";
			$link["@data-bs-toggle"] = "collapse";
			$link["@aria-expanded"] = "false";
			$link["icon"] = $options["icon"];

			$buffer->xlink("#", $options["title"], $link);

			$options["@id"] = $this->id;
			$options[".collapse"] = true;
			$buffer->div_($options);

				$collapse_inner = $options["/collapse_inner"];
				$collapse_inner[".collapse-inner"] = true;

				$buffer->div_($collapse_inner);
					foreach ($this->item_arr as $item){
						switch ($item['type']){
							case "link": $buffer->xlink($item["@href"], $item["label"], $item); break;
							case "divider": $buffer->div([".collapse-divider" => true]); break;
							case "header": $buffer->xheader($item["size"], $item["title"], false, $item); break;
							case "html": $buffer->add($item["html"]); break;
						}
					}

				$buffer->_div();
			$buffer->_div();

		$buffer->_div();
		
		return $buffer->build();

	}
	//--------------------------------------------------------------------------------
}