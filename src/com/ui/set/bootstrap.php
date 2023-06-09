<?php

namespace Kwerqy\Ember\com\ui\set;

/**
 * @package mod\ui\set
 * @author Ryno Van Zyl
 */
class bootstrap extends \Kwerqy\Ember\com\ui\intf\set {
	//--------------------------------------------------------------------------------
	// magic
	//--------------------------------------------------------------------------------
	protected function __construct($options = []) {
		// init
		$this->name = "Bootstrap";
	}
	//--------------------------------------------------------------------------------
	// functions
	//--------------------------------------------------------------------------------
	// functions
	//--------------------------------------------------------------------------------
	public function get($name, $options = []) {
	    $options_arr = array_merge([
	    ], $options);

		$class = $this->get_class_name($name);

		return $class::make($options);
	}
	//--------------------------------------------------------------------------------
    protected function get_class_name($name){

		//evaluate app - bootstrap folder
	    if(file_exists(DIR_COM."/ui/set/website/$name.php")){
	        return "\\Kwerqy\\Ember\\com\\ui\set\\website\\{$name}";
        }
        //default to com
	    return "\\Kwerqy\\Ember\\com\\ui\set\\bootstrap\\{$name}";

    }
	//--------------------------------------------------------------------------------
	public function get_js_includes() {
		// init
		$path_js = DIR_COM."/ui/incl/js";
		$path_vendor = ROOTPATH."/vendor";

		$js_arr = [

            //bootstrap
		    "{$path_vendor}/twbs/bootstrap/dist/js/bootstrap.min.js",

            //fontawesome
		    "{$path_vendor}/fortawesome/font-awesome/js/all.min.js",

            //https://docs.dropzone.dev/getting-started/setup/imperative
		    "{$path_vendor}/enyo/dropzone/dist/min/dropzone.min.js",

            //https://github.com/fengyuanchen/jquery-cropper
		    "{$path_vendor}/fengyuanchen/cropper/dist/cropper.min.js",

            //ember
		    "{$path_js}/ember.mod.ui.incl.app.js",
		    "{$path_js}/ember.mod.ui.incl.panel.js",
		    "{$path_js}/ember.mod.ui.incl.form.js",
		    "{$path_js}/ember.mod.ui.incl.table.js",
		    "{$path_js}/ember.mod.ui.incl.popup.js",
		    "{$path_js}/ember.mod.ui.incl.toast.js",
		];

		// done
		return $js_arr;
	}
	//--------------------------------------------------------------------------------
	public function get_css_includes() {
		// init
        $path_css = DIR_COM."/ui/incl/css";
		$path_vendor = ROOTPATH."/vendor";

		$css_arr = [

		    //bootstrap
		    "{$path_css}/bootstrap.css",
		    "{$path_css}/bootstrap-grid.css",
		    "{$path_css}/bootstrap-reboot.css",

            //https://docs.dropzone.dev/getting-started/setup/imperative
		    "{$path_vendor}/enyo/dropzone/dist/min/dropzone.min.css",

            //https://github.com/fengyuanchen/jquery-cropper
		    "{$path_vendor}/fengyuanchen/cropper/dist/cropper.min.css",

            //ember
		    "{$path_css}/ember.mod.ui.incl.app.css",
		];

		// done
		return $css_arr;
	}
	//--------------------------------------------------------------------------------
}