<?php

namespace Kwerqy\Ember\com\compiler;

/**
 * @package mod\debug
 * @author Ryno Van Zyl
 */
class assets extends \Kwerqy\Ember\com\intf\standard {

	protected $css_arr = [];
	protected $js_arr = [];

	protected $dest = false;
	protected $section;

	//--------------------------------------------------------------------------------
	protected function __construct($options = []) {

		$options = array_merge([
		    "section" => "system"
		], $options);

		$this->section = \Kwerqy\Ember\Ember::get_section($options["section"]);

		$this->css_arr = $this->section->get_ui()->get_css_includes();
		$this->js_arr = $this->section->get_ui()->get_js_includes();

		$this->dest = DIR_WRITABLE."/cache/ui";

	}
	//--------------------------------------------------------------------------------
	private function write_file($asset_arr, $filename){

	    $is_js = strpos($filename, ".js") !== false;

		\Kwerqy\Ember\com\os\os::mkdir(dirname($filename));

		if(!\Kwerqy\Ember\com\os\os::is_newer_than($filename, $asset_arr)){
			if($is_js){
                $minifier = new \MatthiasMullie\Minify\JS();
                foreach ($asset_arr as $asset_file){
                    if(file_exists($asset_file)){
                        $minifier->add($asset_file);
                    }else{
                        throw new \Exception("Asset file not found: $asset_file");
                    }
                }
                $minifier->minify($filename);
            }else{
                $minifier = new \MatthiasMullie\Minify\CSS();
                foreach ($asset_arr as $asset_file){
                    if(file_exists($asset_file)){
                        $minifier->add($asset_file);
                    }else{
                        throw new \Exception("Asset file not found: $asset_file");
                    }
                }
                $minifier->minify($filename);
            }
		}

	}
	//--------------------------------------------------------------------------------
	public function run($options = []) {

		$minified_css = $this->dest."/{$this->section->get_set()}/ui.min.css";
		$this->write_file($this->css_arr, $minified_css);

		$minified_js = $this->dest."/{$this->section->get_set()}/ui.min.js";
		$this->write_file($this->js_arr, $minified_js);

		return $this;
	}
	//--------------------------------------------------------------------------------
	public function get_stream_css($options = []) {

	    $buffer = \Kwerqy\Ember\com\ui\ui::make()->buffer();

	    $css_includes_arr = $this->section->get_ui()->get_css_cdn_includes();
	    foreach ($css_includes_arr["pre"] as $include){
	        $buffer->link(["@rel" => "stylesheet", "@href" => $include]);
        }

	    $filename = WRITEPATH."cache/ui/{$this->section->get_set()}/ui.min.css";
	    $buffer->link(["@rel" => "stylesheet", "@href" => site_url(["stream", "xasset", "ui", $this->section->get_set(), "ui.min.css"])."?cache=".filemtime($filename)]);

	    foreach ($css_includes_arr["post"] as $include){
	        $buffer->link(["@rel" => "stylesheet", "@href" => $include]);
        }

		return $buffer->build();

	}
	//--------------------------------------------------------------------------------
	public function get_stream_js($options = []) {

	    $buffer = \Kwerqy\Ember\com\ui\ui::make()->buffer();

	    $css_includes_arr = $this->section->get_ui()->get_js_cdn_includes();

	    foreach ($css_includes_arr["pre"] as $include){
	        $buffer->script(["@src" => $include]);
        }

	    $filename = WRITEPATH."cache/ui/{$this->section->get_set()}/ui.min.js";
	    $buffer->script(["@src" => site_url(["stream", "xasset", "ui", $this->section->get_set(), "ui.min.js"])."?cache=".filemtime($filename)]);

	    foreach ($css_includes_arr["post"] as $include){
	        $buffer->script(["@src" => $include]);
        }

	    //init
		$buffer->add(\Kwerqy\Ember\com\js\js::get_script());
		$buffer->add(\Kwerqy\Ember\com\js\js::get_domready());

		return $buffer->build();

	}
	//--------------------------------------------------------------------------------
}