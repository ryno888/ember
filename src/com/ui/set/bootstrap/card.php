<?php

namespace Kwerqy\Ember\com\ui\set\bootstrap;

/**
 * @package mod\ui\set\system
 * @author Ryno Van Zyl
 */
class card extends \Kwerqy\Ember\com\ui\intf\component {
	//--------------------------------------------------------------------------------
	// magic
	//--------------------------------------------------------------------------------
	protected function __construct($options = []) {
		// init
		$this->name = "Card";
	}
	//--------------------------------------------------------------------------------
	public function build($options = []) {

		$options = array_merge([
			"color" => "primary",
			"icon" => false,
			"title" => false,
			"sub_title" => false,
			"header" => false,
			"html" => false,

			"/card" => [".h-100 py-2" => true],
			"/card_header" => [".card-header" => true],
			"/card_body" => [".card-body" => true],
			"/title" => [".text-xs font-weight-bold text-uppercase mb-1" => true],
			"/sub_title" => [".h5 mb-0 font-weight-bold text-gray-800" => true],
			"/icon" => [".fa-2x text-gray-300" => true],
		], $options);


		$buffer = \Kwerqy\Ember\com\ui\ui::make()->buffer();

		$options["/card"][".card"] = true;
		$options["/card"][".border-left-{$options["color"]}"] = true;

		if(is_callable($options["title"]))
            $options["title"] = $options["title"]();

		$buffer->div_($options["/card"]);

		    $buffer->div($options["/card_header"]);

			$buffer->div_($options["/card_body"]);

				if($options["html"]){

				    if($options["title"]){

				        $buffer->div_([".row no-gutters align-items-center mb-3" => true]);
                            $buffer->div_([".col mr-2" => true]);
                                $options["/title"][".text-{$options["color"]}"] = true;
                                $options["/title"]["*"] = $options["title"];
                                $buffer->div($options["/title"]);
                            $buffer->_div();
                        $buffer->_div();
                    }

				    if(is_callable($options["html"]))
				        $options["html"] = $options["html"]();

                    $buffer->add($options["html"]);

				}else{
					$buffer->div_([".row no-gutters align-items-center" => true]);
						$buffer->div_([".col mr-2" => true]);

							$options["/title"][".text-{$options["color"]}"] = true;
							$options["/title"]["*"] = $options["title"];
							$buffer->div($options["/title"]);

							if($options["sub_title"]){
								$options["/sub_title"]["*"] = $options["sub_title"];
								$buffer->div($options["/sub_title"]);
							}

						$buffer->_div();

						if($options["icon"]){
							$buffer->div_([".col-auto" => true]);
								$buffer->xicon($options["icon"], $options["/icon"]);
							$buffer->_div();
						}
					$buffer->_div();
				}


			$buffer->_div();


		$buffer->_div();

		return $buffer->build();

	}
	//--------------------------------------------------------------------------------
}