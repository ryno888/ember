<?php

namespace Kwerqy\Ember\com\ui\set\bootstrap;

/**
 * @package mod\ui\set\system
 * @author Ryno Van Zyl
 */
class html extends \Kwerqy\Ember\com\ui\intf\component {
	//--------------------------------------------------------------------------------
	// fields
	//--------------------------------------------------------------------------------
	/**
	 * @var mixed|buffer
	 */
	protected $buffer;

	//form
	public $form_id;
	public $form_action = null;
	public $form_validate = null;
	public $form_submit_js = false;

	public $form_js_arr = [];
	//--------------------------------------------------------------------------------
	// magic
	//--------------------------------------------------------------------------------
	protected function __construct($options = []) {
		// init
		$this->name = "HTML";
		$this->buffer = \Kwerqy\Ember\com\ui\ui::make()->buffer();
	}
	//--------------------------------------------------------------------------------
	public function __call($name, $arguments) {
		if(!method_exists($this, $name)){
			call_user_func_array([$this->buffer, $name], $arguments);
		}
	}
	//--------------------------------------------------------------------------------
	public function form($action, $validate = false, $options = []) {
		$options = array_merge([
		    ".needs-validation" => true,
		    "id" => \Kwerqy\Ember\com\str\str::generate_id(["prefix" => "form"]),
		    "@novalidate" => true,
		    "@class" => "",
		], $options);

		$this->form_action = $action;
		$this->form_validate = $validate;

		$class_arr = \mod\arr::extract_signature_items(".", $options);
		foreach ($class_arr as $key => $value){
			if($value === true){
				$options["@class"] .= "$key ";
			}
		}

		$this->form_id = $options["@id"] = $options["id"];
		$options["@name"] = $options["id"];
		$options["@class"] = trim($options["@class"]);

		$attr_arr = \mod\arr::extract_signature_items("@", $options);
		foreach ($attr_arr as $key => $value){
			if($value === true){
				$attr_arr[$key] = substr($value, 1, strlen($value));
			}
		}

		$this->buffer->add(form_open($this->form_action, $attr_arr));

		$honeypot = \core::get_env("honeypot.name");
		if($honeypot){
            $this->buffer->div_([".d-none" => true]);
                $this->buffer->label(["*" => "Security Field"]);
                $this->buffer->xinput("text", $honeypot, false);
            $this->buffer->_div();
        }

		$this->form_js_arr[] = "
		    var {$this->form_id};
		    $(function(){
		        {$this->form_id} = new form({
                    id: '#{$this->form_id}',
                    action: '#{$this->form_action}',
                });
		    });
		";

	}
	//--------------------------------------------------------------------------------
    public function get_submit_button($options = []) {

	    $options = array_merge([
	        "label" => "Save Changes",
	        "@id" => \Kwerqy\Ember\com\str\str::generate_id(["prefix" => "btn_submit"]),
	        ".ui-form-submit" => true,
	    ], $options);

	    $buffer = \Kwerqy\Ember\com\ui\ui::make()->buffer();
	    $buffer->xbutton($options["label"], false, $options);

	    $this->form_js_arr[] = "
		    $(function(){
	            $('body').on('click', '#{$options["@id"]}', function(){
	               {$this->get_submit_js($options)}
	            });
	        });
		";

        return $buffer->build();
    }
	//--------------------------------------------------------------------------------
	public function get_submit_js($options = []) {

		$options = array_merge([
		    "*form" => "#{$this->form_id}",
			"*action" => $this->form_action,
		], $options);

		$data = \Kwerqy\Ember\com\js\js::create_options($options);

		$js_arr = [];
		$js_arr[] = "let data = {$data};";
		$js_arr[] = "event.preventDefault();";
		$js_arr[] = "event.stopPropagation();";
		$js_arr[] = \Kwerqy\Ember\com\js\js::ajax($options["*action"], [
			"*form" => "#{$this->form_id}",
			"*beforeSend" => "function(){ 
                app.html.set_btn_loading(btn);
                $('#{$this->form_id}').find('.form-control').removeClass('is-invalid'); 
			}",
			"*success" => "function(response){
			    {$this->form_id}.process_form_response(response);
			    app.html.unset_btn_loading(btn);
			}",
		]);

		return " let btn = $(this); ".implode("\n", $js_arr);
	}
	//--------------------------------------------------------------------------------
	public function __destruct() {
		if($this->form_action){
			$this->buffer->_form();
		}
	}
	//--------------------------------------------------------------------------------
	public function apply_options($options = []) {

		$options = array_merge([
		    "required" => false
		], $options);

	}
	//--------------------------------------------------------------------------------
	public function submit_button($options = []) {
        $this->buffer->add($this->get_submit_button($options));

	}
	//--------------------------------------------------------------------------------
	public function itext($label, $id, $value = false, $options = []) {

		$this->apply_options($options);

		$this->buffer->xform_input($id, function($buffer) use($label, $id, $value, $options){
			$buffer->xitext($id, $value, $label, $options);
		}, $options);

	}
	//--------------------------------------------------------------------------------
	public function idate($label, $id, $value = false, $options = []) {

		$this->apply_options($options);

		$this->buffer->xform_input($id, function($buffer) use($label, $id, $value, $options){
			$buffer->xidate($id, $value, $label, $options);
		}, $options);

	}
	//--------------------------------------------------------------------------------
	public function itextarea($label, $id, $value = false, $options = []) {

		$options = array_merge([
			"id" => $id,
			"label" => $label,
			"value" => $value,

			"help" => false,
			"required" => false,
		], $options);

		$this->apply_options($options);

		$this->buffer->xform_input($id, function($buffer) use($label, $id, $value, $options){
			$buffer->xitextarea($id, $value, $label, $options);
		}, $options);

	}
	//--------------------------------------------------------------------------------
	public function icheckbox($label, $id, $value = false, $options = []) {

		$this->apply_options($options);

		$this->buffer->xform_input($id, function($buffer) use($label, $id, $value, $options){
			$buffer->xicheckbox($id, false, $label, $options);
		}, $options);

	}
	//--------------------------------------------------------------------------------
	public function iradio($label, $id, $input_options_arr, $value = false, $options = []) {

		$this->apply_options($options);

		$this->buffer->xform_input($id, function($buffer) use($label, $id, $input_options_arr, $value, $options){
			$buffer->xiradio($id, $input_options_arr, $value, $label, $options);
		}, $options);

	}
	//--------------------------------------------------------------------------------
	public function iselect($label, $id, $value_options_arr, $value = false, $options = []) {

		$this->apply_options($options);

		$this->buffer->xform_input($id, function($buffer) use($label, $id, $value_options_arr, $value, $options){
			$buffer->xiselect($id, $value_options_arr, $value, $label, $options);
		}, $options);

	}
	//--------------------------------------------------------------------------------
	public function form_input($label, $id, $fn, $options = []) {
		$this->buffer->xform_input($label, $id, $fn, $options);
	}
	//--------------------------------------------------------------------------------
	public function flush($options = []) {
	    echo $this->build($options);
    }
	//--------------------------------------------------------------------------------
	public function build($options = []) {

	    \Kwerqy\Ember\com\js\js::add_script(implode("", $this->form_js_arr));

		return $this->buffer->build();

	}
	//--------------------------------------------------------------------------------
}