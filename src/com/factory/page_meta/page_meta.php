<?php

namespace Kwerqy\Ember\com\factory\page_meta;

/**
 * @package app\ui
 * @author Ryno Van Zyl
 * @copyright Copyright Liquid Edge Solutions. All rights reserved.
 */

class page_meta extends \Kwerqy\Ember\com\intf\standard {

	/**
	 * @var null
	 */
	protected $title, $action, $name, $url, $canonical, $keywords, $description, $author;

	/**
	 * @var array
	 */
	protected $meta_arr = [];

	/**
	 * @var
	 */
	protected $page_image_url;
	protected $page_image_alt;

	protected $noindex = false;

	protected $enable_open_graph = true;
	protected $enable_facebook = true;
	protected $enable_twitter = true;
	protected $enable_google = true;
	protected $google_site_verification;

	protected $is_loaded = false;

	//--------------------------------------------------------------------------------
	protected function __construct($options = []) {
		$options = array_merge([
		    "action" => uri_string(),
		], $options);

		$this->name = getenv("ember.company_name");
		$this->author = "Kwerqy Web Development";

		$this->title = $this->build_title();
		$this->description = getenv("ember.website.description");
		$this->keywords = getenv("ember.website.keywords");
		$this->set_action($options["action"]);

		$this->page_image_url = \Kwerqy\Ember\com\http\http::get_stream_url(DIR_ASSETS_IMG."/logo.png");
		if(\Kwerqy\Ember\Ember::is_live()) $this->google_site_verification = "iuLbNCvMWuivh9u741HOFUnfuwlnEikXE6cslrBgi9E";

	}
	//--------------------------------------------------------------------------------
    private function build_title(){
	    $title_parts = [];
	    $title_parts[] = getenv("ember.title");

	    $view = \Kwerqy\Ember\com\http\http::get_current_view();

	    if($view == "index") $view = "Home";
	    $title_parts[] = \Kwerqy\Ember\com\str\str::propercase($view);

	    return implode(" | ", $title_parts);

    }
	//--------------------------------------------------------------------------------
	/**
	 * @return array
	 */
	public function get_meta_arr(): array {
		return $this->meta_arr;
	}
	//--------------------------------------------------------------------------------

    /**
     * @param mixed $page_image_url
     * @param string $alt
     */
    public function set_page_image_url(string $page_image_url, $alt = "Page Image"): void {
        $this->page_image_url = $page_image_url;
        $this->page_image_alt = $alt;
    }
	//--------------------------------------------------------------------------------
	public function has_description(): bool {
		if(!$this->description) return false;
	}
	//--------------------------------------------------------------------------------
	public function has_title(): bool {
        if(!$this->title) return false;
	}
	//--------------------------------------------------------------------------------
	public function has_keywords(): bool {
        if(!$this->keywords) return false;
	}
	//--------------------------------------------------------------------------------
	public function has_canonical(): bool {
		if(!$this->canonical) return false;
	}
	//--------------------------------------------------------------------------------

	/**
	 * @param null $description
	 */
	public function set_description($description): void {
	    $this->description = $description;
	}
	//--------------------------------------------------------------------------------

	/**
	 * @param null $keywords
	 */
	public function set_keywords($keywords): void {
	    $this->keywords = $keywords;
	}
	//--------------------------------------------------------------------------------
	/**
	 * @param null $title
	 */
	public function set_title($title): void {
	    $this->title = $title;
	}
	//--------------------------------------------------------------------------------
	/**
	 * @param bool $noindex
	 */
	public function set_noindex(bool $noindex): void {
		$this->noindex = $noindex;
	}
	//--------------------------------------------------------------------------------

	/**
	 * @param null $url
	 */
	public function set_url($url): void {
	    $this->url = $url;
	}
	//--------------------------------------------------------------------------------
	/**
	 * @param null $canonical
	 */
	public function set_canonical($canonical): void {
	    $this->canonical = $canonical;
	}
	//--------------------------------------------------------------------------------
	/**
	 * @param null $name
	 */
	public function set_name($name): void {
		$this->name = $name;
	}
	//--------------------------------------------------------------------------------
	/**
	 * @param null $action
	 */
	public function set_action($action): void {
		$this->action = $action;
	}
	//--------------------------------------------------------------------------------
	public function set_twitter_meta() {
		$this->add_meta("twitter:site", $this->url);
		$this->add_meta("twitter:card", $this->page_image_url);
		$this->add_meta("twitter:creator", $this->name);
		$this->add_meta("twitter:title", $this->title);
		$this->add_meta("twitter:description", $this->description);
		$this->add_meta("twitter:image:src", $this->page_image_url);
		$this->add_meta("twitter:image:alt", $this->page_image_alt);
	}
	//--------------------------------------------------------------------------------
	public function set_facebook_meta() {
		$this->add_meta("fb:admins", $this->url);
		$this->add_meta("fb:admins", false);
		$this->add_meta("fb:app_id", false);
		$this->add_meta("article:author", $this->author); 		// only for og:type article. Make empty string if not article ''.
		$this->add_meta("article:publisher", "");	// only for og:type article. Make empty string if not article ''.
	}
	//--------------------------------------------------------------------------------
	public function set_open_graph() {
	    $this->add_meta("og:url", $this->url);
		$this->add_meta("og:type", "website"); // website, article, product, book
		$this->add_meta("og:locale", "en_GB");
		$this->add_meta("og:title", $this->title);
		$this->add_meta("og:image", $this->page_image_url);
		$this->add_meta("og:image:alt", $this->page_image_alt);
		$this->add_meta("og:description", $this->description);
		$this->add_meta("og:site_name", $this->name);
	}
	//--------------------------------------------------------------------------------
	public function set_google_meta() {
		$this->add_meta(false, false, ['@rel' => 'author', '@href' => $this->author, "key" => "google:author"]);
		$this->add_meta(false, false, ['@rel' => 'publisher', '@href' => "Liquid Edge Solutions", "key" => "google:publisher"]);
		$this->add_meta(false, false, ['@itemprop' => 'name', '@content' => $this->name, "key" => "google:company"]);
		$this->add_meta(false, false, ['@itemprop' => 'description', '@content' => $this->description, "key" => "google:description"]);
		$this->add_meta(false, false, ['@itemprop' => 'image', '@content' => $this->page_image_url, "key" => "google:image"]);
	}
	//--------------------------------------------------------------------------------
	public function add_meta($name, $content, $options = []) {

		$options = array_merge([
		    "key" => $name
		], $options);

		if($name && !$content) return;

		$this->meta_arr[$options["key"]] = array_merge([
			"@name" => $name,
			"@content" => $content,
		], $options);

	}
	//--------------------------------------------------------------------------------
	public function load($options = []) {

	    $this->is_loaded = true;

        $this->add_meta(false, false, ['@charset' => 'utf-8', "key" => "charset"]);
        $this->add_meta("viewport", "width=device-width, initial-scale=1.0, shrink-to-fit=no");
        $this->add_meta(false, false, ['@http-equiv' => 'x-ua-compatible', '@content' => 'ie=edge', "key" => "http-equiv"]);
        $this->add_meta("google-site-verification", $this->google_site_verification);
        if($this->noindex) $this->add_meta("robots", "noindex, nofollow");

        $this->add_meta("title", $this->title);
        $this->add_meta("author", $this->author);
        $this->add_meta("description", $this->description);
        $this->add_meta("keywords", $this->keywords);
        $this->add_meta("canonical", $this->canonical);

        if($this->enable_open_graph) $this->set_open_graph();
        if($this->enable_facebook) $this->set_facebook_meta();
        if($this->enable_twitter) $this->set_twitter_meta();
        if($this->enable_google) $this->set_google_meta();

	}
	//--------------------------------------------------------------------------------
	public function build($options = []) {
	    
	    $options = array_merge([
	        "section" => "bootstrap"
	    ], $options);

		$this->load();

		$buffer = \Kwerqy\Ember\com\ui\ui::make($options)->buffer();
		$buffer->title(["*" => $this->title]);
		foreach ($this->meta_arr as $meta){
			$buffer->meta($meta);
		}
		return $buffer->build();

	}
	//--------------------------------------------------------------------------------
}