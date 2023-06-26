<?php

namespace Kwerqy\Ember\com\ui\set;

/**
 * @package mod\ui\set
 * @author Ryno Van Zyl
 */
class system extends \Kwerqy\Ember\com\ui\intf\set {
	//--------------------------------------------------------------------------------
	// magic
	//--------------------------------------------------------------------------------
	protected function __construct($options = []) {
		// init
		$this->name = "system";
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
	public function get_js_includes():array {
		// init
		$path_js = DIR_COM."/ui/incl/js";
		$path_vendor = DIR_VENDOR;

		$asset_arr = [];

		//jquery UI
		$asset_arr[] = "{$path_vendor}/components/jqueryui/jquery-ui.min.js";

		//bootstrap
		$asset_arr[] = "{$path_vendor}/twbs/bootstrap/dist/js/bootstrap.min.js";

		//https://github.com/botmonster/jquery-bootpag
		$asset_arr[] = "{$path_vendor}/intelogie/jquery-bootpag/lib/jquery.bootpag.min.js";

        //https://docs.dropzone.dev/getting-started/setup/imperative
		$asset_arr[] = "{$path_vendor}/enyo/dropzone/dist/min/dropzone.min.js";

		//https://github.com/fengyuanchen/jquery-cropper
		$asset_arr[] = "{$path_vendor}/fengyuanchen/cropper/dist/cropper.min.js";


		//ember
        $asset_arr[] = "{$path_js}/ember.mod.ui.incl.app.js";
        $asset_arr[] = "{$path_js}/ember.mod.ui.incl.panel.js";
        $asset_arr[] = "{$path_js}/ember.mod.ui.incl.form.js";
        $asset_arr[] = "{$path_js}/ember.mod.ui.incl.table.js";
        $asset_arr[] = "{$path_js}/ember.mod.ui.incl.popup.js";
        $asset_arr[] = "{$path_js}/ember.mod.ui.incl.toast.js";

        //bootstrap
        $file_arr = glob(DIR_ASSETS."/ui/bootstrap/js/*");
        foreach ($file_arr as $file) $asset_arr[] = $file;

        //ember
		if(file_exists("{$path_js}/js.css")) $asset_arr[] = "{$path_js}/js.css";

        //section
        $file_arr = glob(DIR_ASSETS."/ui/system/js/*");
        foreach ($file_arr as $file) $asset_arr[] = $file;

		// done
		return $asset_arr;
	}
	//--------------------------------------------------------------------------------
	public function get_css_includes():array {
		// init
        $path_css = DIR_COM."/ui/incl/css";
		$path_vendor = DIR_VENDOR;

		$asset_arr = [];

		$file_arr = glob(DIR_ASSETS."/ui/bootstrap/css/*");
        foreach ($file_arr as $file) $asset_arr[] = $file;
		
		//https://docs.dropzone.dev/getting-started/setup/imperative
		$asset_arr[] = "{$path_vendor}/enyo/dropzone/dist/min/dropzone.min.css";

		//https://github.com/fengyuanchen/jquery-cropper
		$asset_arr[] = "{$path_vendor}/fengyuanchen/cropper/dist/cropper.min.css";

		//bootstrap
        $file_arr = glob(DIR_ASSETS."/ui/bootstrap/css/*");
        foreach ($file_arr as $file) $asset_arr[] = $file;

        //ember
		if(file_exists("{$path_css}/app.css")) $asset_arr[] = "{$path_css}/app.css";

		//custom
        $file_arr = glob(DIR_ASSETS."/ui/app/css/*");
        foreach ($file_arr as $file) $asset_arr[] = $file;

        //section
        $file_arr = glob(DIR_ASSETS."/ui/system/css/*");
        foreach ($file_arr as $file) $asset_arr[] = $file;


		// done
		return $asset_arr;
	}
	//--------------------------------------------------------------------------------
    public function get_js_cdn_includes(): array {
	    return [
	        "pre" => [
                //https://popper.js.org/
                "https://unpkg.com/@popperjs/core@2",
            ],
            "post" => [
                //https://michalsnik.github.io/aos/
                "https://unpkg.com/aos@2.3.1/dist/aos.js",

                //https://fancyapps.com/fancybox/getting-started/
                "https://cdn.jsdelivr.net/npm/@fancyapps/ui@5.0/dist/fancybox/fancybox.umd.js",
            ]
        ];
    }

	//--------------------------------------------------------------------------------
    public function get_css_cdn_includes(): array {
	    return [
	        "pre" => [
	            //font-awesome 5
	            "https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.0/css/all.min.css"
            ],
            "post" => [
                //https://michalsnik.github.io/aos/
                "https://unpkg.com/aos@2.3.1/dist/aos.css",

                //https://fancyapps.com/fancybox/getting-started/
                "https://cdn.jsdelivr.net/npm/@fancyapps/ui@5.0/dist/fancybox/fancybox.css",
            ]
        ];
    }
	//--------------------------------------------------------------------------------
}