<?php

namespace Kwerqy\Ember\com\incl\dropzone;

/**
 * @package mod\intf
 * @author Ryno Van Zyl
 */
class cropper extends \Kwerqy\Ember\com\intf\standard {

    /**
	 * 0: no restrictions
	 * 1: restrict the crop box not to exceed the size of the canvas.
	 * 2: restrict the minimum canvas size to fit within the container. If the proportions of the canvas and the container differ, the minimum canvas will be surrounded by extra space in one of the dimensions.
	 * 3: restrict the minimum canvas size to fill fit the container. If the proportions of the canvas and the container are different, the container will not be able to fit the whole canvas in one of the dimensions.
	 * @var int
	 */
	protected $view_mode = 1;

    protected $identifier;

    protected $index;

    protected $src_filename;

    protected string $on_close = "";
    protected string $on_crop = "function(event){}";

    protected string $url;
    protected string $delete_url;

    protected $desired_width = 800;
    protected $desired_height = 500;

    protected $post_data_arr = [];

	//--------------------------------------------------------------------------------
	protected function __construct($options = []) {

	    $options = array_merge([
	        "session_id" => false,
	        "index" => false,
	        "url" => \Kwerqy\Ember\com\http\http::build_action_url("dropzone/xcrop"),
	        "delete_url" => \Kwerqy\Ember\com\http\http::build_action_url("dropzone/xdelete_file"),
	    ], $options);

	    // init
		$this->name = "Cropper";
		$this->identifier = \Kwerqy\Ember\com\str\str::generate_id("cropper");
		$this->url = $options["url"];
		$this->delete_url = $options["delete_url"];
	}
	//--------------------------------------------------------------------------------
    /**
     * @param string $on_crop
     */
    public function set_on_crop(string $on_crop): void {
        $this->on_crop = $on_crop;
    }
	//--------------------------------------------------------------------------------
    /**
     * @param string $on_close
     */
    public function set_on_close(string $on_close): void {
        $this->on_close = $on_close;
    }
	//--------------------------------------------------------------------------------
    public function add_data($key, $value) {
        $this->post_data_arr[$key] = $value;
    }
	//--------------------------------------------------------------------------------
    public function set_width($width) {
        $this->desired_width = $width;
    }
    //--------------------------------------------------------------------------------
    public function set_height($height) {
        $this->desired_height = $height;
    }
	//--------------------------------------------------------------------------------

//    /**
//     * @param session $session
//     */
//    public function set_session(session $session): void {
//        $this->session = $session;
//    }
	//--------------------------------------------------------------------------------
    public function set_src($filename) {
        $this->src_filename = $filename;
    }
	//--------------------------------------------------------------------------------
    public function build($options = []) {

	    $options = array_merge([
		], $options);

	    $buffer = \Kwerqy\Ember\com\ui\ui::make()->buffer();
	    $buffer->div_([".container-fluid" => true]);
	        $buffer->div_([".row" => true]);
	            $buffer->div_([".col-12" => true]);
	                $toolbar = \Kwerqy\Ember\com\ui\ui::make()->toolbar();

	                $toolbar->add_button("Crop", \Kwerqy\Ember\com\js\js::ajax($this->url, [
	                    "*data" => "!{$this->identifier}.buildPostData()",
	                    "*success" => "function(response){
	                        app.browser.close_popup();
	                    }",
                    ]), [".btn_{$this->identifier}" => true]);

	                $toolbar->add_button("Cancel", "{$this->on_close}; app.browser.close_popup();");

                    $buffer->add($toolbar->build());
	            $buffer->_div();
	        $buffer->_div();

	        $buffer->div_([".row" => true]);
	            $buffer->div_([".col-12" => true]);
                    $buffer->div_([".ui-cropper-wrapper" => true]);
                        $buffer->ximage(\Kwerqy\Ember\com\http\http::get_stream_url($this->src_filename), ["@id" => $this->identifier]);
                    $buffer->_div();
	            $buffer->_div();
	        $buffer->_div();
	    $buffer->_div();


	    $js_options = [];
		$js_options["*responsive"] = true;
		$js_options["*checkOrientation"] = true;

		$js_options["*minContainerWidth"] = 400;
		$js_options["*minContainerHeight"] = 200;

		$js_options["*wheelZoomRatio"] = 0.05;
		$js_options["*rotatable"] = false;
		$js_options["*viewMode"] = $this->view_mode;
		$js_options["*aspectRatio"] = "!{$this->parse_ratio()}";
		$js_options["*crop"] = "!function(event){}";


        $buffer->script(["*" => "
            
            var {$this->identifier};
            
            $(function(){
                let image_cropper = $('#{$this->identifier}');

                image_cropper.cropper(".\Kwerqy\Ember\com\js\js::create_options($js_options).");
            
                {$this->identifier} = image_cropper.data('cropper');
                {$this->identifier}.buildPostData = function(){
                    return $.extend({
                        crop_x: {$this->identifier}.getData().x,
                        crop_y: {$this->identifier}.getData().y,
                        crop_width: {$this->identifier}.getData().width,
                        crop_height: {$this->identifier}.getData().height,
                        desired_width: {$this->desired_width},
                        desired_height: {$this->desired_height},
                    }, ".json_encode($this->post_data_arr).");
                };
                
                
            });
            
        "]);

		return $buffer->build();

    }
    //--------------------------------------------------------------------------------
	public function parse_ratio() {
		$separator = " / ";
		$gcd = function ($a, $b) use (&$gcd) {
			return ($a % $b) ? $gcd($b, $a % $b) : $b;
		};
		$g = $gcd($this->desired_width, $this->desired_height);
		return $this->desired_width / $g . $separator . $this->desired_height / $g;
	}
	//--------------------------------------------------------------------------------
}