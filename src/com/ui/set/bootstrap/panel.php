<?php

namespace Kwerqy\Ember\com\ui\set\bootstrap;

/**
 * @package mod\ui\set\system
 * @author Ryno Van Zyl
 */
class panel extends \Kwerqy\Ember\com\ui\intf\component {

    protected $id;
    protected $url;
    protected $html;
    protected $options = [];

	//--------------------------------------------------------------------------------
	// magic
	//--------------------------------------------------------------------------------
	protected function __construct($options = []) {

	    $options = array_merge([
	        "id" => \Kwerqy\Ember\Ember::$request->get_get("p", TYPE_STRING, ["default" => \Kwerqy\Ember\com\str\str::generate_id(["prefix" => "panel"])]),
	        "url" => false,
	        "html" => false,
            ".ui-panel" => true,
	    ], $options);

		// init
		$this->name = "Panel";
		$this->id = $options["id"];

		$this->url = $options["url"];
		$this->html = $options["html"];
		$this->options = $options;
	}
	//--------------------------------------------------------------------------------
    /**
     * @param mixed $url
     */
    public function set_url($url): void {
        $this->url = $url;
    }
	//--------------------------------------------------------------------------------
    /**
     * @param mixed $html
     */
    public function set_html($html): void {
        $this->html = $html;
    }
	//--------------------------------------------------------------------------------
    public function get_script() {
        $js_options = \Kwerqy\Ember\com\js\js::create_options([
            "*id" => $this->id,
            "*url" => $this->url,
        ]);

        return "
            if(typeof {$this->id} === 'undefined'){
                var {$this->id};
                $(function(){
                    
                    {$this->id} = new panel({$js_options});
                    ".(!$this->html ? "{$this->id}.refresh();" : "")."
                });
            }
        ";
    }
	//--------------------------------------------------------------------------------
	public function build($options = []) {

	    $options = array_merge([
	        "@id" => $this->id
        ],$this->options, $options);

	    $buffer = \Kwerqy\Ember\com\ui\ui::make()->buffer();

	    if(\Kwerqy\Ember\com\http\http::is_panel_request()){
	        $buffer->add($this->html);
        }else{
            $buffer->div_($options);
                $buffer->add($this->html);
            $buffer->_div();

            \Kwerqy\Ember\com\js\js::add_script($this->get_script());
        }

	    return $buffer->build();
	}
	//--------------------------------------------------------------------------------
}