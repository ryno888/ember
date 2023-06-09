<?php

namespace Kwerqy\Ember\com\ui\set;

/**
 * @package mod\ui\set
 * @author Ryno Van Zyl
 */
class website extends system {
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
	    if(file_exists(DIR_MOD."/ui/set/website/mod.ui.set.custom.$name.php")){
	        return "\\mod\\ui\\set\\custom\\{$name}";
        }

        //evaluate app - bootstrap folder
	    if(file_exists(DIR_MOD."/ui/set/website/mod.ui.set.website.$name.php")){
	        return "\\mod\\ui\\set\\website\\{$name}";
        }

        //default to com
	    return "\\mod\\ui\\set\\system\\{$name}";

    }
    //--------------------------------------------------------------------------------
	public function get_js_includes() {
		// init
		$path_js = DIR_MOD."/ui/incl/js";
		$path_vendor = ROOTPATH."/vendor";
		$path_vendor_append = ROOTPATH."/vendor_append";

		$js_arr = [

            //popperjs
		    "{$path_vendor_append}/popperjs/popper.min.js",

            //jquery UI
		    "{$path_vendor_append}/jquery-ui-1.13.2.custom/jquery-ui.min.js",

            //bootstrap
		    "{$path_vendor}/twbs/bootstrap/dist/js/bootstrap.min.js",

            //fontawesome
		    "{$path_vendor}/fortawesome/font-awesome/js/all.min.js",

            //https://michalsnik.github.io/aos/
		    "{$path_vendor_append}/aos-master/dist/aos.js",

            //https://github.com/botmonster/jquery-bootpag
		    "{$path_vendor_append}/jquery-bootpag-master/lib/jquery.bootpag.min.js",

            //https://bootstrap-extension.com/index.php
		    "{$path_vendor_append}/bootstrap-extension-5.2.1/js/bootstrap-extension.min.js",


            //https://docs.dropzone.dev/getting-started/setup/imperative
		    "{$path_vendor}/enyo/dropzone/dist/min/dropzone.min.js",

            //https://github.com/fengyuanchen/jquery-cropper
		    "{$path_vendor}/fengyuanchen/cropper/dist/cropper.min.js",

            //fancybox
		    DIR_MOD."/incl/fancybox/inc/js/jquery.fancybox.js",
		    DIR_MOD."/incl/fancybox/inc/js/jquery.fancybox.addon.js",

            //ember
		    "{$path_js}/ember.mod.ui.incl.app.js",
		    "{$path_js}/ember.mod.ui.incl.panel.js",
		    "{$path_js}/ember.mod.ui.incl.form.js",
		    "{$path_js}/ember.mod.ui.incl.table.js",
		    "{$path_js}/ember.mod.ui.incl.popup.js",
		    "{$path_js}/ember.mod.ui.incl.toast.js",

            "{$path_vendor_append}/ember/website/js/bootstrap.parallax.js",

		];

		// done
		return $js_arr;
	}
	//--------------------------------------------------------------------------------
	public function get_css_includes() {
		// init
        $path_css = DIR_MOD."/ui/incl/css";
		$path_vendor = ROOTPATH."/vendor";
		$path_vendor_append = ROOTPATH."/vendor_append";

		$css_arr = [

		    //bootstrap
		    "{$path_css}/bootstrap.css",
		    "{$path_css}/bootstrap-grid.css",
		    "{$path_css}/bootstrap-reboot.css",

            //https://michalsnik.github.io/aos/
		    "{$path_vendor_append}/aos-master/dist/aos.css",

            //https://bootstrap-extension.com/index.php
		    "{$path_vendor_append}/bootstrap-extension-5.2.1/css/bootstrap-extension.css",

            //https://github.com/botmonster/jquery-bootpag
		    "{$path_vendor_append}/jquery-bootpag-master/css/jquery.bootpag.css",

            //https://docs.dropzone.dev/getting-started/setup/imperative
		    "{$path_vendor}/enyo/dropzone/dist/min/dropzone.min.css",

            //https://github.com/fengyuanchen/jquery-cropper
		    "{$path_vendor}/fengyuanchen/cropper/dist/cropper.min.css",

            //fancybox
            DIR_MOD."/incl/fancybox/inc/css/jquery.fancybox.css",
		    DIR_MOD."/incl/fancybox/inc/css/jquery.fancybox.addon.css",

            //ember
		    "{$path_css}/ember.mod.ui.incl.app.css",

            //custom
            "{$path_vendor_append}/ember/website/css/website.css",
		];

		// done
		return $css_arr;
	}
	//--------------------------------------------------------------------------------
}