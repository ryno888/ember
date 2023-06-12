<?php

namespace Kwerqy\Ember\com\ui\set;

/**
 * @package mod\ui\set
 * @author Ryno Van Zyl
 */
class website extends bootstrap {
	//--------------------------------------------------------------------------------
	// magic
	//--------------------------------------------------------------------------------
	protected function __construct($options = []) {
		// init
		$this->name = "Website";
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
	    if(file_exists(DIR_COM."/ui/set/custom/$name.php")){
	        return "\\Kwerqy\\Ember\\com\\ui\set\\custom\\{$name}";
        }

	    //evaluate app - bootstrap folder
	    if(file_exists(DIR_COM."/ui/set/website/$name.php")){
	        return "\\Kwerqy\\Ember\\com\\ui\set\\website\\{$name}";
        }
        //default to com
	    return "\\Kwerqy\\Ember\\com\\ui\set\\bootstrap\\{$name}";

    }
    //--------------------------------------------------------------------------------
	public function get_js_includes():array {
		// init
		$path_js = DIR_COM."/ui/incl/js";
		$path_vendor = DIR_VENDOR;

		$js_arr = [

            //popperjs
//		    "{$path_vendor}/rsportella/popper",
//		    "{$path_vendor_append}/popperjs/popper.min.js",

            //jquery UI
		    "{$path_vendor}/components/jqueryui/jquery-ui.min.js",

            //bootstrap
		    "{$path_vendor}/twbs/bootstrap/dist/js/bootstrap.min.js",

            //fontawesome
		    "{$path_vendor}/fortawesome/font-awesome/js/all.min.js",

            //https://github.com/botmonster/jquery-bootpag
		    "{$path_vendor}/intelogie/jquery-bootpag/lib/jquery.bootpag.min.js",

            //https://bootstrap-extension.com/index.php
//		    "{$path_vendor_append}/bootstrap-extension-5.2.1/js/bootstrap-extension.min.js",


            //https://docs.dropzone.dev/getting-started/setup/imperative
		    "{$path_vendor}/enyo/dropzone/dist/min/dropzone.min.js",

            //https://github.com/fengyuanchen/jquery-cropper
		    "{$path_vendor}/fengyuanchen/cropper/dist/cropper.min.js",

            //fancybox
		    "{$path_vendor}/lagman/fancybox/source/jquery.fancybox.pack.js",

            //ember
		    "{$path_js}/ember.mod.ui.incl.app.js",
		    "{$path_js}/ember.mod.ui.incl.panel.js",
		    "{$path_js}/ember.mod.ui.incl.form.js",
		    "{$path_js}/ember.mod.ui.incl.table.js",
		    "{$path_js}/ember.mod.ui.incl.popup.js",
		    "{$path_js}/ember.mod.ui.incl.toast.js",

//            "{$path_vendor_append}/ember/website/js/bootstrap.parallax.js",
		];

		// done
		return $js_arr;
	}
	//--------------------------------------------------------------------------------
	public function get_css_includes():array {
		// init
        $path_css = DIR_COM."/ui/incl/css";
		$path_vendor = DIR_VENDOR;

		$css_arr = [

		    //bootstrap
		    "{$path_css}/bootstrap.css",
		    "{$path_css}/bootstrap-grid.css",
		    "{$path_css}/bootstrap-reboot.css",

            //https://docs.dropzone.dev/getting-started/setup/imperative
		    "{$path_vendor}/enyo/dropzone/dist/min/dropzone.min.css",

            //https://github.com/fengyuanchen/jquery-cropper
		    "{$path_vendor}/fengyuanchen/cropper/dist/cropper.min.css",

            //fancybox
            "{$path_vendor}/lagman/fancybox/source/jquery.fancybox.css",

            //ember
		    "{$path_css}/ember.mod.ui.incl.app.css",

            //custom
//            "{$path_vendor_append}/ember/website/css/website.css",
		];

		// done
		return $css_arr;
	}
	//--------------------------------------------------------------------------------
    public function get_js_cdn_includes(): array {
	    return [
	        //https://michalsnik.github.io/aos/
		    "https://unpkg.com/aos@2.3.1/dist/aos.js",
        ];
    }

	//--------------------------------------------------------------------------------
    public function get_css_cdn_includes(): array {
	    return [
	        //https://michalsnik.github.io/aos/
		    "https://unpkg.com/aos@2.3.1/dist/aos.css",
        ];
    }
	//--------------------------------------------------------------------------------
}