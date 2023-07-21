<?php

namespace Kwerqy\Ember\com\ui\set\bootstrap;

/**
 * @package mod\ui\set\system
 * @author Ryno Van Zyl
 */
class table extends \Kwerqy\Ember\com\intf\standard {

	protected $id;

    /**
     * @var \Kwerqy\Ember\com\db\sql\select
     */
	protected $sql;

	protected $total_items = 0;
	protected $total_pages = 0;
	protected $limit = 20;
	protected $offset = 0;
	protected $page = 1;
	protected $search = "";
	protected $search_field = "";
	protected $is_reset = false;
	protected $sortfield = 0;
	protected $sortorder = 0;

	protected $key = "";

	protected $options = [];

	protected $action_arr = [];
	protected $field_arr = [];
	public $item_arr = [];

	protected $is_db_init = false;
	protected $is_ajax_request = false;

	protected $enable_toolbar = true;

    /**
     * @var toolbar
     */
	protected $toolbar_left, $toolbar_right;

	//--------------------------------------------------------------------------------
	// magic
	//--------------------------------------------------------------------------------
	protected function __construct($options = []) {

	    $options = array_merge([
	        "/table" => [],
	        "/title" => [],
	    ], $options);

		// init
		$this->name = "Button";
		$this->id = "table_".md5(\Kwerqy\Ember\com\http\http::get_control());

		$this->options = $options;

		$this->toolbar_left = \Kwerqy\Ember\com\ui\ui::make()->toolbar();
		$this->toolbar_right = \Kwerqy\Ember\com\ui\ui::make()->toolbar();
		$this->is_ajax_request = \Kwerqy\Ember\com\http\http::is_ajax() && \Kwerqy\Ember\Ember::$request->get("ui_table", TYPE_STRING) == $this->id;

		$this->parse_requests();

	}
	//--------------------------------------------------------------------------------
    /**
     * @return string
     */
    public function get_id(): string {
        return $this->id;
    }
	//--------------------------------------------------------------------------------
    /**
     * @param string $key
     */
    public function set_key(string $key): void {
        $this->key = $key;
    }
	//--------------------------------------------------------------------------------
    public function set_title($title, $sub_title = false, $options = []) {
        
        $options = array_merge([
            "size" => 2,
            "title" => $title,
            "sub_title" => $sub_title,
            ".my-2" => true,
        ], $options);

        $this->options["/title"] = $options;
    }
	//--------------------------------------------------------------------------------
	public function build($options = []) {

		$options = array_merge([
		], $options);

		if($this->sql) $this->init_db();

		$buffer = \Kwerqy\Ember\com\ui\ui::make()->buffer();
		$this->build_html($buffer);
        $this->build_js($buffer);

		if($this->is_ajax_request){
		    ob_clean();
		    \Kwerqy\Ember\com\http\http::json($buffer->build());
		    exit();
        }

		return $buffer->build();
	}
	//--------------------------------------------------------------------------------

    /**
     * function($table, $toolbar){}
     * @param $fn
     */
    public function nav_append_left($fn) {
        call_user_func_array($fn, [$this, &$this->toolbar_left]);
    }
	//--------------------------------------------------------------------------------
    public function nav_append_right($fn) {
        call_user_func_array($fn, [$this, &$this->toolbar_right]);
    }
	//--------------------------------------------------------------------------------
    public function request_value($id, $datatype, $options = []) {

        $options = array_merge([
            "default" => false,
        ], $options);

        //load from request
        $value = \Kwerqy\Ember\Ember::$request->get($id, $datatype, $options);

        //attempt to load from session
        $session_id = "{$this->id}{$id}";
        $session_data = \Kwerqy\Ember\Ember::$session->get($session_id, ["datatype" => $datatype]);

        if($this->is_reset){
            $value = $this->get_request_defaults()[$id];
            \Kwerqy\Ember\Ember::$session->set($session_id, $value);
            return $value;
        }

        if($datatype == TYPE_INT){
            if(\Kwerqy\Ember\Ember::$request->get("is_sort", TYPE_BOOL) || \Kwerqy\Ember\Ember::$request->get("page", TYPE_INT)) \Kwerqy\Ember\Ember::$session->set($session_id, $value);
            else $value = $session_data;
        }else{
            if($value == $options["default"]) $value = $session_data;
            else \Kwerqy\Ember\Ember::$session->set($session_id, $value);
        }

        $value = \Kwerqy\Ember\com\data\data::parse($value, $datatype);

        return $value;
    }
	//--------------------------------------------------------------------------------
    public function parse_requests() {

        $id = \Kwerqy\Ember\Ember::$request->get("ui_table", TYPE_STRING);
        if($id) $this->id = $id;

        $this->is_reset = \Kwerqy\Ember\Ember::$request->get("is_reset", TYPE_BOOL);

        $this->page = $this->request_value("page", TYPE_INT, ["default" => 1]);
        $this->search = $this->request_value("search", TYPE_STRING);
        $this->sortfield = $this->request_value("sortfield", TYPE_INT);
        $this->sortorder = $this->request_value("sortorder", TYPE_INT);

        return $this->get_requests();
    }
	//--------------------------------------------------------------------------------
    public function get_requests() {
        return [
            "page" => $this->page,
            "search" => $this->search,
            "is_reset" => $this->is_reset,
            "sortfield" => $this->sortfield,
            "sortorder" => $this->sortorder,
            "id" => $this->id,
        ];
    }
	//--------------------------------------------------------------------------------
    public function get_request_defaults() {
        return [
            "page" => 1,
            "search" => false,
            "is_reset" => false,
            "id" => $this->id,
            "sortfield" => 0,
            "sortorder" => 0,
        ];
    }
	//--------------------------------------------------------------------------------
    public function set_search_field($field) {

        $this->search_field = $field;

        $this->toolbar_left->add_html(function(){
            return \Kwerqy\Ember\com\ui\ui::make()->itext("search[{$this->id}]", $this->search, false, [
                ".form-control-sm" => true,
                "@placeholder" => "Search",
                "!enter" => "$('.btn[data-identifier=btn-search-{$this->id}]').click();",
            ]);
        });
        $this->toolbar_left->add_button(false, "{$this->id}.search();", [".btn-primary btn-sm" => true, "icon" => "fa-search", "@data-identifier" => "btn-search-{$this->id}"]);
        $this->toolbar_left->add_button("Reset", "{$this->id}.reset();", [".btn-primary btn-sm" => true, "@data-identifier" => "btn-reset-{$this->id}"]);
    }
	//--------------------------------------------------------------------------------

	/**
	 * @param $sql \mod\db\sql\select | callable
	 */
	public function set_sql($sql) {

	    if(!is_string($sql) && is_callable($sql)){
	        $sql = $sql();
        }

		$this->sql = $sql;
	}
	//--------------------------------------------------------------------------------

    /**
     * @param $title
     * @param $field
     * @param array $options
     *  function($content, $item_index, $field_index, $table){}
     */
	public function add_field($title, $field, $options = []){

	    $options = array_merge([
	        "title" => $title,
	        "index" => $field,

	        "function" => false,
	        "sortfield" => $field,
	        "nosort" => false,

	    ], $options);

		$this->field_arr[] = $options;
	}
	//--------------------------------------------------------------------------------

	public function add_action($label, $onclick, $options = []){

	    $options = array_merge([
	        "type" => "button",
	        "label" => $label,
	        "!click" => $onclick,
	        "/td" => [],
	    ], $options);

		$this->action_arr[] = $options;
	}
	//--------------------------------------------------------------------------------

	public function add_action_link($label, $href, $options = []){

	    $options = array_merge([
	        "type" => "link",
	        "label" => $label,
	        "@href" => $href,
	        "/td" => [],
	    ], $options);

		$this->action_arr[] = $options;
	}
	//--------------------------------------------------------------------------------

    /**
     * function($item_data, $dropdown, $table){}
     * @param $fn
     * @param array $options
     */
	public function add_action_dropdown($fn, $options = []){

	    $options = array_merge([
	        "type" => "dropdown",
	        "function" => $fn,
            "/td" => [],
	    ], $options);

		$this->action_arr[] = $options;
	}
	//--------------------------------------------------------------------------------

	public function add_action_sortable($options = []){
	    $this->add_action("", "alert(1)", ["icon" => "fa-arrows-alt-v"]);
	}
	//--------------------------------------------------------------------------------
    public function is_stream() {
        return \Kwerqy\Ember\com\http\http::is_ajax() && isset($_REQUEST["ui_table"]);
    }
	//--------------------------------------------------------------------------------
	public function stream_json_data() {

		if($this->is_stream()){
			if($this->sql && !$this->is_db_init){
				$this->init_db();

				$buffer = \Kwerqy\Ember\com\ui\ui::make()->buffer();
				$this->build_thead($buffer);
			    $this->build_tbody($buffer);
			    if($this->item_arr) $this->build_tfoot($buffer);

			    $buffer->script(["*" => "
			        $(function(){
			            let total_pages = parseInt('{$this->total_pages}');
			            let total_items = parseInt('{$this->total_items}');
			            if(total_pages > 1){
                            $('#{$this->id}_pagination').removeClass('d-none');
                            $('#{$this->id}_pagination').bootpag({total:total_pages, page:{$this->page}});
			            }else{
                            $('#{$this->id}_pagination').addClass('d-none');
			            }
			        });
			    "]);

			    ob_clean();

                \Kwerqy\Ember\com\http\http::json($buffer->build());
            }
			return "stream";
		}

	}
	//--------------------------------------------------------------------------------
	public function init_db() {

	    //init
		$this->is_db_init = true;

		//search
		if($this->search){
	        $this->sql->like($this->search_field, $this->search);
        }


		//get total entries
		$clone = clone $this->sql;
		$clone->clear_select();
		$clone->select_count($this->key);
		$this->total_items = \Kwerqy\Ember\Ember::db()->selectsingle($clone->build());
		$this->total_pages = ceil($this->total_items/$this->limit);

		//sql
        $this->offset = ($this->page == 1 ? 0 : ($this->limit * ($this->page-1)));
	    if($this->sql->is_empty("limit")) $this->sql->limit($this->limit);
	    $this->sql->offset($this->offset);

	    $sortfield = $this->field_arr[$this->sortfield]["sortfield"];
	    if($sortfield){
	        $this->sql->orderby($sortfield, $this->sortorder == 0 ? "ASC" : "DESC");
        }

	    //build
		$this->item_arr = $this->sql->run();
	}
	//--------------------------------------------------------------------------------
    private function init_pagination() {

        $this->toolbar_right->add_html(function(){
	        return \Kwerqy\Ember\com\ui\ui::make()->pagination([
	            "/wrapper" => [".d-none" => $this->total_pages <= 1],
	            "id" => "{$this->id}_pagination",
	            "*total" => $this->total_pages,
                "*page" => $this->page,
                "*maxVisible" => 5,
                "*firstLastUse" => true,
                "*leaps" => false,

                "*next" => \Kwerqy\Ember\com\ui\ui::make()->icon("fa-angle-right"),
                "*prev" => \Kwerqy\Ember\com\ui\ui::make()->icon("fa-angle-left"),

                "*first" => \Kwerqy\Ember\com\ui\ui::make()->icon("fa-angle-double-left"),
                "*last" => \Kwerqy\Ember\com\ui\ui::make()->icon("fa-angle-double-right"),

                "!click" => "function(page){ 
                    {$this->id}.paginate(page);
                }",

                "*wrapClass" => "ui-pagination",
                "*activeClass" => "active",
                "*disabledClass" => "disabled",
                "*nextClass" => "next",
                "*prevClass" => "previous",
                "*lastClass" => "last",
                "*firstClass" => "first",
            ]);
        });
    }
	//--------------------------------------------------------------------------------
    private function build_toolbar(&$buffer) {

	    $this->init_pagination();

	    $is_empty = $this->toolbar_right->is_empty() && $this->toolbar_left->is_empty();

	    if(!$is_empty){
            $buffer->div_([".container-fluid ui-table-toolbar p-0" => true]);

                $buffer->div_([".row align-items-center mt-3 mb-2" => true]);
                    if(!$this->toolbar_left->is_empty()){
                        $buffer->div_([".col-auto" => true]);
                            $buffer->add($this->toolbar_left->build());
                        $buffer->_div();
                    }

                    if(!$this->toolbar_right->is_empty()){
                        $buffer->div_([".col-12 col-md d-flex justify-content-lg-end" => true]);
                            $buffer->add($this->toolbar_right->build());
                        $buffer->_div();
                    }
                $buffer->_div();

            $buffer->_div();
        }

    }
	//--------------------------------------------------------------------------------
    private function build_thead(&$buffer){

        $sortorder = $this->sortorder == 0 ? 1 : 0;

	    $buffer->thead_();
            $buffer->tr_();
                foreach ($this->field_arr as $index => $field){
                    $columns_name = $field["title"];
                    $buffer->th_();
                        $buffer->div_([".d-flex" => true]);
                            $buffer->div_([".w-100" => true]);
                                $buffer->add(\Kwerqy\Ember\com\str\str::propercase($columns_name));
                            $buffer->_div();

                            if(!$field["nosort"]){
                                $buffer->div_();
                                    $buffer->xicon($this->sortorder == 0 ? "fa-sort-amount-down-alt" : "fa-sort-amount-up-alt", [
                                        "!click" => "{$this->id}.sort(parseInt({$index}), parseInt({$sortorder}));",
                                        "#opacity" => $this->sortfield == $index ? false : "0.4",
                                        ".cursor-pointer" => true,
                                    ]);
                                $buffer->_div();
                            }
                        $buffer->_div();
                    $buffer->_th();
                }

                if($this->action_arr){
                    $buffer->th(["@colspan" => sizeof($this->action_arr)]);
                }

            $buffer->_tr();
        $buffer->_thead();
    }
	//--------------------------------------------------------------------------------
    private function build_tbody(&$buffer){

	    $buffer->body_();
        foreach ($this->item_arr as $item_index => $item_data){
            $buffer->tr_(["@data-row-id" => $item_data[$this->key]]);

            foreach ($this->field_arr as $field_index => $field_item){

                $field_name = $field_item["index"];
                $field_value = $item_data[$field_name];
                if($field_item["function"]){
                    $field_value = call_user_func_array($field_item["function"], [&$item_data[$field_name], $item_index, $field_index, $this]);
                }

                $field_item["*"] = $field_value;
                $buffer->td($field_item);
            }

            if($this->action_arr){
                foreach ($this->action_arr as $field_index => $field_item){

                    switch ($field_item["type"]){
                        case "dropdown":
                            $id = "{$this->get_id()}_{$item_index}_{$field_index}";
                            $dropdown = \Kwerqy\Ember\com\ui\ui::make()->dropdown();
                            $dropdown->set_id($id);

                            call_user_func_array($field_item["function"], [$item_data, &$dropdown, $this]);
                            $field_item["/td"]["*"] = $dropdown->build(["icon" => "fa-ellipsis-v", "/link" => [".btn btn-light border btn-sm font-small" => true, ".dropdown-toggle" => false, "#padding" => "0.4rem 0.5rem"],]);
                            break;

                        case "button":

                            $onclick = $field_item["!click"];
                            unset($field_item["!click"]);
                            foreach ($item_data as $field => $value){
                                if(isnull($value)) $value = false;
                                $onclick = str_replace(urlencode("%{$field}%"), $value, $onclick);
                                $onclick = str_replace("%{$field}%", $value, $onclick);
                            }

                            $field_item["/td"]["*"] = \Kwerqy\Ember\com\ui\ui::make()->button($field_item["label"], $onclick, array_merge([".btn border btn-sm font-small" => true, ".btn-light" => true], $field_item));
                            break;

                        case "link":

                            $href = $field_item["@href"];
                            unset($field_item["@href"]);
                            foreach ($item_data as $field => $value){
                                if(isnull($value)) $value = false;
                                $href = str_replace(urlencode("%{$field}%"), $value, $href);
                                $href = str_replace("%{$field}%", $value, $href);
                            }

                            $field_item["/td"]["*"] = \Kwerqy\Ember\com\ui\ui::make()->link($href, $field_item["label"], array_merge([".btn border btn-sm font-small" => true, ".btn-light" => true], $field_item));
                            break;
                    }


                    $field_item["/td"][".ui-table-action"] = true;
                    $buffer->td($field_item["/td"]);
                }
            }
            $buffer->_tr();
        }

        if(!$this->item_arr){
            $buffer->tr_();
                $buffer->td(["*" => "No results found", ".py-3" => true, "@colspan" => sizeof($this->field_arr)+1]);
            $buffer->_tr();
        }

        $buffer->_body();
    }
	//--------------------------------------------------------------------------------
    private function build_tfoot(&$buffer){

	    $columns_name_arr = array_column($this->field_arr, "title");

	    $buffer->tfoot_();
            $buffer->tr_();
                foreach ($columns_name_arr as $columns_name)
                    $buffer->th(["*" => \Kwerqy\Ember\com\str\str::propercase($columns_name)]);
            $buffer->_tr();
        $buffer->_tfoot();
    }
	//--------------------------------------------------------------------------------
	private function build_html(&$buffer, $options = []){

	    if($this->is_ajax_request){
	        $this->build_thead($buffer);
            $this->build_tbody($buffer);
            $this->build_tfoot($buffer);
        }else{
	        $buffer->div_([".ui-table-wrapper" => true, "@data-id" => $this->id]);

                if($this->options["/title"]){
                    $buffer->xheader($this->options["/title"]["size"], $this->options["/title"]["title"], $this->options["/title"]["sub_title"], $this->options["/title"]);
                }
                if($this->enable_toolbar) $this->build_toolbar($buffer);
                
                $table_opt = array_merge([
                    ".table" => true,
                    ".table-bordered" => true,
                    ".valign-middle" => true,
                    "@id" => $this->id,
                ], $this->options["/table"]);

                $buffer->table_($table_opt);
                    $this->build_thead($buffer);
                    $this->build_tbody($buffer);
                    $this->build_tfoot($buffer);
                $buffer->_table();
			$buffer->_div();
        }
	}
	//--------------------------------------------------------------------------------
	private function build_js(&$buffer){

		$js_options = [];
		$js_options["*id"] = $this->id;
		$js_options["*url"] = current_url()."?ui_table={$this->id}";
		$js_options["*panel"] = \Kwerqy\Ember\Ember::$panel;
		$js_options["*total_pages"] = $this->total_pages;
		$js_options["*total_items"] = $this->total_items;
		$js_options = \Kwerqy\Ember\com\js\js::create_options($js_options);

		$buffer->script(["*" => "
		    if(typeof {$this->id} === 'undefined'){
                var {$this->id};
                $(function(){
                    {$this->id} = new table({$js_options});
                });
            }else{
                {$this->id}.set_options({$js_options});
            }
		"]);
	}
	//--------------------------------------------------------------------------------
}