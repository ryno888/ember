<?php

namespace Kwerqy\Ember\com\data\type;

/**
 * Class data
 * @package app
 * @author Ryno Van Zyl
 */

class type_html extends \Kwerqy\Ember\com\data\type\intf\standard {

    //--------------------------------------------------------------------------------
	// properties
	//--------------------------------------------------------------------------------
	protected $name = "HTML";
	protected $datatype = "text";
	protected $default = false;
	protected $type = TYPE_HTML;
	//--------------------------------------------------------------------------------
	// static
	//--------------------------------------------------------------------------------
	/**
	 * @param $value
	 * @param array $options
	 * @return bool
	 */
    public function parse($value, $options = []) {

        // options
		$options = array_merge([
			"allow_tag_arr" => [],
		], $options);

    	// remove grouped tags and content
    	$value = \Kwerqy\Ember\com\str\str::replace($value, [
    		"/<style[^>]*?>.*?<\\/style>/siu" => "",
    		"/<head[^>]*?>.*?<\\/head>/siu" => "",
    		"/<script[^>]*?>.*?<\\/script>/siu" => "",
    		"/<object[^>]*?>.*?<\\/object>/siu" => "",
    		"/<embed[^>]*?>.*?<\\/embed>/siu" => "",
    		"/<applet[^>]*?>.*?<\\/applet>/siu" => "",
    		"/<noframes[^>]*?>.*?<\\/noframes>/siu" => "",
    		"/<noscript[^>]*?>.*?<\\/noscript>/siu" => "",
    		"/<noembed[^>]*?>.*?<\\/noembed>/siu" => "",
    		"/<area[^>]*?>.*?<\\/area>/siu" => "",
    		"/<marquee[^>]*?>.*?<\\/marquee>/siu" => "",
    		"/<menu[^>]*?>.*?<\\/menu>/siu" => "",
    		"/<select[^>]*?>.*?<\\/select>/siu" => "",
    		"/<textarea[^>]*?>.*?<\\/textarea>/siu" => "",
    		"/<map[^>]*?>.*?<\\/map>/siu" => "",
    	]);

		// allow tags
		$allow_tags = false;
		if ($options["allow_tag_arr"]) {
			foreach ($options["allow_tag_arr"] as $allow_tags_item) {
				$allow_tags .= "<{$allow_tags_item}>";
			}
		}

    	// strip tags, but keep some safe ones
		$value = strip_tags($value, "<b><strong><i><em><u><font><p><div><img><br><span><h1><h2><h3><h4><h5><h6><pre><table><tr><td><th><li><ul><ol>{$allow_tags}");

    	// remove on attributes
    	$value = preg_replace("/\\s*on[a-z0-9%;&]*=(\\'|\\\").*(\\'|\\\")/siu", "", $value);

    	// done
    	return $value;

    }
    //--------------------------------------------------------------------------------
    function get_dbvalue(): string {
        return "TEXT";
    }
    //--------------------------------------------------------------------------------

}
