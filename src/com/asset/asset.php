<?php

namespace Kwerqy\Ember\com\asset;

/**
 * @package mod\debug
 * @author Ryno Van Zyl
 */
class asset {
	//--------------------------------------------------------------------------------
	public static function mkdir($dir, $options = []) {
		if (!is_dir($dir)) {
            mkdir($dir, 0777, true);
        }
        return str_replace("//", "/", $dir);
	}
	//--------------------------------------------------------------------------------
    public static function get_logo_filename() {
        if(file_exists(DIR_ASSETS_IMG."/logo.png"))
            return DIR_ASSETS_IMG."/logo.png";

        return DIR_ASSETS_IMG."/__logo.png";
    }
    //--------------------------------------------------------------------------------
    public static function get_logo_slim_filename() {
        if(file_exists(DIR_ASSETS_IMG."/logo_slim.png"))
            return DIR_ASSETS_IMG."/logo_slim.png";

        return self::get_logo_filename();
    }
	//--------------------------------------------------------------------------------
    public static function get_favicon_filename() {
        if(file_exists(DIR_ASSETS_IMG."/favicon.png"))
            return DIR_ASSETS_IMG."/favicon.png";

        return DIR_ASSETS_IMG."/__favicon.png";
    }
	//--------------------------------------------------------------------------------
}