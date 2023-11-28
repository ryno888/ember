<?php

namespace Kwerqy\Ember\com\ui;

class ui extends \Kwerqy\Ember\com\intf\standard {

	public static $bootstrap_color_arr = [
        "blue" => "blue",
        "indigo" => "indigo",
        "purple" => "purple",
        "pink" => "pink",
        "red" => "red",
        "orange" => "orange",
        "yellow" => "yellow",
        "green" => "green",
        "teal" => "teal",
        "cyan" => "cyan",
        "white" => "white",
        "gray" => "gray",
        "gray-dark" => "gray-dark",
        "primary" => "primary",
        "primary-dark" => "primary-dark",
        "secondary" => "secondary",
        "success" => "success",
        "info" => "info",
        "warning" => "warning",
        "danger" => "danger",
        "light" => "light",
        "dark" => "dark",
    ];

    public static $bootstrap_theme_arr = [
        "primary",
		"primary-dark",
		"secondary",
		"success",
		"info",
		"warning",
		"danger",
		"light",
		"dark",
    ];

    /**
     * @var false|mixed |\Kwerqy\Ember\com\intf\section
     */
	protected $section;

	//--------------------------------------------------------------------------------
	public function __construct($options = []) {

		$options = array_merge([
		    "section" => "bootstrap"
		], $options);

		$this->section = \Kwerqy\Ember\Ember::get_section($options["section"]);

	}

	//--------------------------------------------------------------------------------
    public function apply_options(&$options = []) {
        $options = array_merge([
            "@title" => false
        ], $options);

        if($options["@title"]){
            $options["@data-bs-toggle"] = $options["@title"];
        }
    }
	//--------------------------------------------------------------------------------
	/**
	 * @return false|mixed|\Kwerqy\Ember\com\ui\ui\intf\set
	 */
	public function get_ui_set() {

		$set = $this->section->get_set();

		if(!$set) $set = "bootstrap";

		$path = "\\mod\\ui\\set\\$set";

		return call_user_func([$path, "make"]);

	}
	//--------------------------------------------------------------------------------

    public function ci_controller($section, $page, $options = []) {
	    return \Kwerqy\Ember\com\ci\controller\controller::make()->build($section, $page, $options);
    }
    //--------------------------------------------------------------------------------

	/**
	 * @param $width
	 * @param $height
	 * @param array $options
	 * @return \Kwerqy\Ember\com\ui\set\bootstrap\flip_card|\com\intf\standard
	 */
	public function flip_card($width, $height, $options = []) {

		$options = array_merge([
		    "width" => $width,
			"height" => $height,
		], $options);

		return \Kwerqy\Ember\com\ui\set\bootstrap\flip_card::make($options);
	}
	//--------------------------------------------------------------------------------

    /**
     * @param $controller
     *
     * function($controller, $view){}
     * @param $fn
     * @param array $options
     * @return string
     */

    public function ci_view($controller, $fn, $options = []) {
        return \Kwerqy\Ember\com\ci\view\view::make($controller, $options)->run($fn);
    }
    //--------------------------------------------------------------------------------
	/**
	 * @param $src
	 * @param false $html
	 * @param array $options
	 * @return mixed
	 */
	public function parallax($src, $html = false, $options = []) {

		$options = array_merge([
		    "src" => $src,
		    "html" => $html,
		], $options);

		return \Kwerqy\Ember\com\ui\set\bootstrap\parallax::make()->build($options);
	}
	//--------------------------------------------------------------------------------
    /**
     * @param array $options
     * @return \Kwerqy\Ember\com\intf\standard|set\bootstrap\offcanvas
     */
	public function offcanvas($options = []) {
		return $this->section->get_ui()->get("offcanvas", $options);
	}
	//--------------------------------------------------------------------------------

    /**
     * @param array $options
     * @return \Kwerqy\Ember\com\intf\standard|set\bootstrap\image_card
     */
	public function image_card($options = []) {

		return $this->section->get_ui()->get("image_card", $options);
	}
	//--------------------------------------------------------------------------------

    /**
     * @param array $options
     * @return \Kwerqy\Ember\com\intf\standard|set\bootstrap\ul
     */
	public function ul($options = []) {

		$options_arr = array_merge([
		], $options);

		return $this->section->get_ui()->get("ul");
	}
	//--------------------------------------------------------------------------------

    /**
     * @param array $options
     * @return mixed
     */
	public function loader($options = []) {
	    return $this->section->get_ui()->get("loader")->build($options);
	}
	//--------------------------------------------------------------------------------

    /**
     * @param array $options
     * @return mixed
     */
	public function scrolltotop($options = []) {
	    return $this->section->get_ui()->get("scrolltotop")->build($options);
	}
	//--------------------------------------------------------------------------------

    /**
     * @param $url
     * @param array $options
     * @return \Kwerqy\Ember\com\intf\standard|set\bootstrap\panel
     */
    public function panel($url, $options = []) {
	    $options = array_merge([
	        "url" => $url,
	    ], $options);

	    return $this->section->get_ui()->get("panel", $options);

    }
    //--------------------------------------------------------------------------------
	/**
	 * @param $id
	 * @param int $value
	 * @param array $options
	 * @return false|string|null
	 */
	public function icounter($id, $value = 0, $options = []) {

		$options = array_merge([
		    "id" => $id,
		    "value" => $value,
		    "label" => false,
		    "!change" => false,
			"min" => 0,
			"max" => null,
		], $options);

		return $this->section->get_ui()->get("icounter")->build($options);
	}
	//--------------------------------------------------------------------------------
    /**
     * @param array $options
     * @return false|string|null|\Kwerqy\Ember\com\ui\set\bootstrap\pagination
     */
    public function pagination( $options = []) {
	    return $this->section->get_ui()->get("pagination")->build($options);
    }
	//--------------------------------------------------------------------------------

	/**
	 * @param array $options
	 * @return mixed| \Kwerqy\Ember\com\ui\set\bootstrap\page_loader
	 */
	public function page_loader($options = []) {

		return $this->section->get_ui()->get("page_loader")->build($options);

	}
	//--------------------------------------------------------------------------------

	/**
	 * @param array $options
	 * @return mixed| \Kwerqy\Ember\com\ui\set\bootstrap\debug
	 */
	public function debug($options = []) {

		return $this->section->get_ui()->get("debug")->build($options);

	}
	//--------------------------------------------------------------------------------

	/**
	 * @param array $options
	 * @return mixed| \Kwerqy\Ember\com\ui\set\bootstrap\toolbar
	 */
	public function toolbar($options = []) {

		return $this->section->get_ui()->get("toolbar", $options);

	}
	//--------------------------------------------------------------------------------

	public function form($action, $options = []) {

		$options = array_merge([
		    "id" => str::generate_id(["prefix" => "form"]),
		    "action" => $action,
		], $options);

		return $this->section->get_ui()->get("form")->build($options);

	}
	//--------------------------------------------------------------------------------

	/**
	 * @param false $id
	 * @param array $options
	 * @return mixed|\Kwerqy\Ember\com\ui\set\bootstrap\table
	 */
	public function table($id = false, $options = []) {

		$options = array_merge([
		    "id" => $id,
		], $options);

		return $this->section->get_ui()->get("table", $options);

	}
	//--------------------------------------------------------------------------------

	/**
	 * @param array $options
	 * @return mixed| \Kwerqy\Ember\com\ui\set\bootstrap\list_inline
	 */
	public function list_inline($options = []) {

		return $this->section->get_ui()->get("list_inline", $options);

	}
	//--------------------------------------------------------------------------------

	/**
	 * @param array $options
	 * @return mixed| \Kwerqy\Ember\com\ui\set\bootstrap\tag
	 */
	public function tag($options = []) {

		return $this->section->get_ui()->get("tag", $options);

	}
	//--------------------------------------------------------------------------------

	/**
	 * @param array $options
	 * @return mixed| \Kwerqy\Ember\com\ui\set\bootstrap\toast
	 */
	public function toast($options = []) {

		return $this->section->get_ui()->get("toast", $options);

	}
	//--------------------------------------------------------------------------------
	public function dropzone($id, $dest, $options = []) {

		$options = array_merge([
			"filetype_group" => \Kwerqy\Ember\com\os\filetype_group\images::make(),

			"crop" => false,
			"!crop" => false,
			"crop_width" => 800,
			"crop_height" => 400,

			"max_files" => 5,
			"!complete" => "function(file, response){}",
			"!delete" => "function(file){}",
		], $options);

		// options
		$options["id"] = $id;
		$options["dest"] = $dest;

		// done
		return $this->section->get_ui()->get("dropzone")->build($options);
	}
	//--------------------------------------------------------------------------------

	/**
	 * @param array $options
	 * @return mixed| \Kwerqy\Ember\com\ui\set\bootstrap\buffer
	 */
	public function buffer($options = []) {

		return $this->section->get_ui()->get("buffer", $options);

	}
	//--------------------------------------------------------------------------------

	/**
	 * @param array $options
	 * @return mixed| \Kwerqy\Ember\com\ui\set\bootstrap\dropdown
	 */
	public function dropdown($options = []) {

		return $this->section->get_ui()->get("dropdown", $options);

	}
	//--------------------------------------------------------------------------------
	/**
	 * @param $email
	 * @param false $label
	 * @param false $icon
	 * @param array $options
	 * @return mixed|ui\set\system\link|string
	 */
	public function dropdown_email($email, $label = false, $icon = false, $options = []) {

		if(!$label) $label = $email;

		$options["title"] = $label;
		$options["email"] = $email;
		$options["icon"] = $icon;

		// done
		return \Kwerqy\Ember\com\ui\set\custom\dropdown_email::make()->build($options);
	}
    //--------------------------------------------------------------------------------

	/**
	 * @param $number
	 * @param false $label
	 * @param false $icon
	 * @param array $options
	 * @return mixed
	 */
	public function dropdown_number($number, $label = false, $icon = false, $options = []) {

		if(!$number) return "";

		$dropdown_number = \Kwerqy\Ember\com\ui\set\custom\dropdown_number::make();

		if(!$label) $label = $number;

		$dropdown_number->add_number($number, $label, $icon);

		$options["icon"] = $icon;

		// done
		return $dropdown_number->build($options);

	}
	//--------------------------------------------------------------------------------

    /**
     * @param array $options
     * @return mixed|\Kwerqy\Ember\com\ui\set\bootstrap\carousel
     */
	public function carousel($options = []) {

		return $this->section->get_ui()->get("carousel", $options);
	}
	//--------------------------------------------------------------------------------

	/**
	 * @param array $options
	 * @return mixed
	 */
	public function space($height = 10, $options = []) {
		$options["height"] = $height;
		return $this->section->get_ui()->get("space")->build($options);

	}
	//--------------------------------------------------------------------------------

	/**
	 * @param array $options
	 * @return mixed | \Kwerqy\Ember\com\ui\set\bootstrap\collapse
	 */
	public function collapse($options = []) {

		return $this->section->get_ui()->get("collapse", $options);

	}
	//--------------------------------------------------------------------------------

	/**
	 * @param $title
	 * @param false $sub_title
	 * @param array $options
	 * @return mixed | \Kwerqy\Ember\com\ui\set\bootstrap\card
	 */
	public function card($title, $sub_title = false, $options = []) {

		$options = array_merge([
			"color" => "primary",
		    "icon" => false,
		    "title" => $title,
		    "sub_title" => $sub_title,
            "html" => false,
		], $options);

		return $this->section->get_ui()->get("card")->build($options);

	}
	//--------------------------------------------------------------------------------
	/**
	 * @param $value
	 * @param string $color
	 * @param array $options
	 * @return mixed | \Kwerqy\Ember\com\ui\set\bootstrap\progress
	 */
	public function progress($value, $color = "primary", $options = []) {

		$options = array_merge([
			"color" => $color,
			"value" => $value,
			"value_min" => 0,
			"value_max" => 100,
			"enable_label" => true,
		], $options);

		return $this->section->get_ui()->get("progress")->build($options);

	}
	//--------------------------------------------------------------------------------

	/**
	 * @param array $options
	 * @return mixed| \Kwerqy\Ember\com\ui\set\bootstrap\dropdown_menu
	 */
	public function dropdown_menu($options = []) {

		return $this->section->get_ui()->get("dropdown_menu", $options);

	}
	//--------------------------------------------------------------------------------

	/**
	 * @param string $type
	 * @param array $options
	 * @return mixed|\Kwerqy\Ember\com\ui\set\bootstrap\navbar
	 */
	public function navbar($options = []) {
	    
        $options = array_merge([
            "type" => "standard"
        ], $options);

		return $this->section->get_ui()->get("navbar", $options);

	}
	//--------------------------------------------------------------------------------

	/**
	 * @param $icon
	 * @param array $options
	 * @return mixed | \Kwerqy\Ember\com\ui\set\bootstrap\icon
	 */
	public function icon($icon, $options = []) {

		$options["icon"] = $icon;

		return $this->section->get_ui()->get("icon")->build($options);

	}
	//--------------------------------------------------------------------------------

	/**
	 * @param $href
	 * @param false $label
	 * @param array $options
	 * @return mixed | \Kwerqy\Ember\com\ui\set\bootstrap\link
	 */
	public function link($href, $label = null, $options = []) {

		$options = array_merge([
		    "label" => $label,
		    "@href" => $href,
		    "icon" => false,
		], $options);

		return $this->section->get_ui()->get("link")->build($options);

	}
	//--------------------------------------------------------------------------------

	/**
	 * @param $href
	 * @param false $label
	 * @param array $options
	 * @return mixed | \Kwerqy\Ember\com\ui\set\bootstrap\link
	 */
	public function image($src, $options = []) {

		$options = array_merge([
		    "@src" => $src,
		], $options);

		return $this->section->get_ui()->get("image")->build($options);

	}
	//--------------------------------------------------------------------------------

	/**
	 * @param $size
	 * @param $title
	 * @param false $sub_title
	 * @param array $options
	 * @return mixed | \Kwerqy\Ember\com\ui\set\bootstrap\header
	 */
	public function header($size, $title, $sub_title = false, $options = []) {

		$options = array_merge([
		    "size" => $size,
		    "title" => $title,
		    "sub_title" => $sub_title,
		], $options);

		$this->apply_options($options);

		return $this->section->get_ui()->get("header")->build($options);

	}
	//--------------------------------------------------------------------------------

	/**
	 * @param $label
	 * @param string $onclick
	 * @param array $options
	 * @return mixed | \Kwerqy\Ember\com\ui\set\bootstrap\button
	 */
	public function button($label, $onclick = false, $options = []) {

		$options = array_merge([
		    "label" => $label,
		    "!click" => $onclick,
		], $options);

		return $this->section->get_ui()->get("button")->build($options);

	}
	//--------------------------------------------------------------------------------

	/**
	 * @param array $options
	 * @return mixed|\Kwerqy\Ember\com\ui\set\bootstrap\button_toolbar
	 */
	public function button_toolbar($options = []) {
		return $this->section->get_ui()->get("button_toolbar", $options);
	}
	//--------------------------------------------------------------------------------

	/**
	 * @param array $options
	 * @return mixed|\Kwerqy\Ember\com\ui\set\bootstrap\vmanage
	 */
	public function vmanage($options = []) {
		return $this->section->get_ui()->get("vmanage", $options);
	}
	//--------------------------------------------------------------------------------

	/**
	 * @param $type
	 * @param $id
	 * @param $value
	 * @param array $options
	 * @return mixed | \Kwerqy\Ember\com\ui\set\bootstrap\input
	 */
	public function input($type, $id, $value, $options = []) {

		$options = array_merge([
		    "@id" => $id,
			"@value" => $value,
			"@type" => $type,
		], $options);

		return $this->section->get_ui()->get("input")->build($options);

	}
	//--------------------------------------------------------------------------------

    /**
     * @param $id
     * @param int $min
     * @param false $max
     * @param array $options
     * @return mixed | \Kwerqy\Ember\com\ui\set\bootstrap\irange
     */
	public function irange($id, $options = []) {

		$options = array_merge([
		    "id" => $id,
		    "value_from" => 0,
		    "value_to" => 1000,
		    "min" => 0,
		    "max" => 1000,
            "/" => [],
		], $options);

		return $this->section->get_ui()->get("irange")->build($options);

	}
	//--------------------------------------------------------------------------------

    /**
     * @param $id
     * @param bool $value
     * @param bool $label
     * @param array $options
     * @return mixed | \Kwerqy\Ember\com\ui\set\bootstrap\itext
     */
	public function itext($id, $value = false, $label = false, $options = []) {

		$options = array_merge([
		    "id" => $id,
			"value" => $value,
			"label" => $label,
		], $options);

		return $this->section->get_ui()->get("itext")->build($options);

	}
	//--------------------------------------------------------------------------------

    /**
     * @param $id
     * @param bool $value
     * @param bool $label
     * @param array $options
     * @return mixed | \Kwerqy\Ember\com\ui\set\bootstrap\itext
     */
	public function icurrency($id, $value = false, $label = false, $options = []) {

		$options = array_merge([
		    "id" => $id,
			"value" => $value,
			"label" => $label,
			"type" => "number",
			"prepend" => \Kwerqy\Ember\Ember::$currency_symbol,
			"fraction" => \Kwerqy\Ember\Ember::$currency_fraction,
			"@min" => false,
			"@max" => false,
			"@placeholder" => false,
		], $options);


		if($options["fraction"] == 2 && !$options["@placeholder"]) $options["@placeholder"] = "0.00";

		return $this->section->get_ui()->get("itext")->build($options);

	}
	//--------------------------------------------------------------------------------

	public function ihidden($id, $value, $options = []) {

		return \Kwerqy\Ember\com\ui\ui::make()->input("hidden", $id, $value, $options);

	}
	//--------------------------------------------------------------------------------

    /**
     * @param $id
     * @param bool $value
     * @param bool $label
     * @param array $options
     * @return mixed | \Kwerqy\Ember\com\ui\set\bootstrap\itextarea
     */
	public function itextarea($id, $value = false, $label = false, $options = []) {

		$options = array_merge([
		    "id" => $id,
			"value" => $value,
			"label" => $label,
			"rows" => 5,
		], $options);

		return $this->section->get_ui()->get("itextarea")->build($options);

	}
	//--------------------------------------------------------------------------------
	/**
	 * @param $id
	 * @param false $checked
	 * @param false $label
	 * @param array $options
	 * @return mixed|\Kwerqy\Ember\com\ui\set\bootstrap\icheckbox_round
	 */
	public function icheckbox_round($id, $checked = false, $label = false, $options = []) {

		$options = array_merge([
		    "id" => $id,
			"checked" => $checked,
			"label" => $label,
		], $options);

		return $this->section->get_ui()->get("icheckbox_round")->build($options);

	}
	//--------------------------------------------------------------------------------
	/**
	 * @param $id
	 * @param false $checked
	 * @param false $label
	 * @param array $options
	 * @return mixed|\Kwerqy\Ember\com\ui\set\bootstrap\icheckbox
	 */
	public function icheckbox($id, $checked = false, $label = false, $options = []) {

		$options = array_merge([
		    "id" => $id,
			"checked" => $checked,
			"label" => $label,
		], $options);

		return $this->section->get_ui()->get("icheckbox")->build($options);

	}
	//--------------------------------------------------------------------------------
	/**
	 * @param $id
	 * @param $input_options_arr
	 * @param false $value
	 * @param false $label
	 * @param array $options
	 * @return mixed
	 */
	public function iradio($id, $input_options_arr, $value = false, $label = false, $options = []) {

		$options = array_merge([
		    "id" => $id,
			"label" => $label,
			"input_options_arr" => $input_options_arr,
			"value" => $value,
		], $options);

		return $this->section->get_ui()->get("iradio")->build($options);

	}
	//--------------------------------------------------------------------------------

    /**
     * @param $key
     * @param bool $value
     * @param array $options
     * @return string
     */
	public function iproperty($dbentry, $key, $options = []) {

	    $options = array_merge([
			"dbentry" => $dbentry,
			"key" => $key,
			"value" => false,
			"label" => false,
			"required" => false,
		], $options);

		return \Kwerqy\Ember\com\ui\set\bootstrap\iproperty::make()->build($options);
	}
	//--------------------------------------------------------------------------------

    /**
     * @param $key
     * @param bool $value
     * @param array $options
     * @return string
     */
	public function isetting($key, $options = []) {

	    $options = array_merge([
			"key" => $key,
			"value" => false,
			"label" => false,
			"required" => false,
		], $options);

		return \app\ui\set\bootstrap\isetting::make()->build($options);
	}
	//--------------------------------------------------------------------------------
    public function iswitch($id, $value = false, $label = false, $options = []) {

	    $options = array_merge([
		    "id" => $id,
			"label" => $label,
			"value" => (bool)$value,
		], $options);

	    return $this->section->get_ui()->get("iswitch")->build($options);

    }
	//--------------------------------------------------------------------------------
    public function message($content, $color = "primary", $options = []) {

	    $options = array_merge([
		    "content" => $content,
			"color" => $color,
		], $options);

	    return $this->section->get_ui()->get("message")->build($options);

    }
	//--------------------------------------------------------------------------------
    public function badge($content, $color = "primary", $options = []) {

	    $options = array_merge([
		    "content" => $content,
			"color" => $color,
		], $options);

	    return $this->section->get_ui()->get("badge")->build($options);

    }
	//--------------------------------------------------------------------------------

    /**
     * @param array $options
     * @return mixed|\Kwerqy\Ember\com\ui\set\bootstrap\breadcrumb
     */
    public function breadcrumb($options = []) {

	    return $this->section->get_ui()->get("breadcrumb", $options);

    }
	//--------------------------------------------------------------------------------

    /**
     * @param array $options
     * @return mixed|\Kwerqy\Ember\com\ui\set\bootstrap\accordion
     */
    public function accordion($options = []) {

	    return $this->section->get_ui()->get("accordion", $options);

    }
	//--------------------------------------------------------------------------------
	/**
	 * @param $id
	 * @param $value_options_arr
	 * @param false $value
	 * @param false $label
	 * @param array $options
	 * @return mixed
	 */
	public function iselect($id, $value_options_arr, $value = false, $label = false, $options = []) {

		$options = array_merge([
		    "id" => $id,
			"label" => $label,
			"value_options_arr" => $value_options_arr,
			"value" => $value,
		], $options);

		return $this->section->get_ui()->get("iselect")->build($options);

	}
	//--------------------------------------------------------------------------------
	public function idate($id, $value = false, $label = false, $options = []) {
		// options
  		$options["id"] = $id;
  		$options["value"] = $value;
  		$options["label"] = $label;

		// done
		return $this->section->get_ui()->get("idate")->build($options);
	}
//	//--------------------------------------------------------------------------------
//	public function idatetime($id, $value = false, $label = false, $options = []) {
//		// options
//  		$options["id"] = $id;
//  		$options["value"] = $value;
//  		$options["label"] = $label;
//
//		// done
//		return $this->set->get("idatetime")->build($options);
//	}
	//--------------------------------------------------------------------------------

	/**
	 * @param $id
	 * @param false $startdate
	 * @param false $enddate
	 * @param false $label
	 * @param array $options
	 * @return false|string|null
	 */
	public function idaterange($id, $startdate = false, $enddate = false, $label = false, $options = []) {

	    // options
  		$options["id"] = $id;
  		$options["startdate"] = $startdate;
  		$options["enddate"] = $enddate;
  		$options["label"] = $label;

	    return $this->section->get_ui()->get("idaterange")->build($options);
	}
	//--------------------------------------------------------------------------------
	/**
	 * @param $id
	 * @param $fn
	 * @param array $options
	 * @return mixed
	 */
	public function form_input($id, $fn, $options = []) {

		$options = array_merge([
		    "id" => $id,
			"fn" => $fn,
		], $options);

		return $this->section->get_ui()->get("form_input")->build($options);

	}
	//--------------------------------------------------------------------------------

	/**
	 * @param array $options
	 * @return mixed | \Kwerqy\Ember\com\ui\set\bootstrap\html
	 */
	public function html($options = []) {
		return $this->section->get_ui()->get("html", $options);
	}
	//--------------------------------------------------------------------------------
    /**
     * @param $url
     * @param array $options
     * @return string
     */
	public function js_popup($url, $options = []) {

	    $options = array_merge([
	        "url" => $url,
            "*title" => "Alert",
            "*width" => "modal-lg",

	    ], $options);

	    return $this->section->get_ui()->get("js_popup")->build($options);
	}
	//--------------------------------------------------------------------------------
	public function fieldset($header, $fn, $options = []) {

	    $options = array_merge([
	        "dropdown" => false
	    ], $options);

	    $fieldset = $this->section->get_ui()->get("fieldset");
	    $fieldset->header($header);
	    $fieldset->body($fn);
	    $fieldset->set_dropdown($options["dropdown"]);

		return $fieldset->build($options);
	}
	//--------------------------------------------------------------------------------
}
