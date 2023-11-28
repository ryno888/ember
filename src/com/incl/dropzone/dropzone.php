<?php

namespace Kwerqy\Ember\com\incl\dropzone;

/**
 * @package mod\intf
 * @author Ryno Van Zyl
 */
class dropzone extends \Kwerqy\Ember\com\intf\standard {

    /**
     * @var session
     */
    protected $session;

    /**
     * @var mixed|\Kwerqy\Ember\com\ui\set\bootstrap\buffer
     */
    protected $buffer;

    protected $identifier;
    
    protected $uploaded_files_arr = [];

	private $options = [];

	//--------------------------------------------------------------------------------

	protected function __construct($options = []) {

		$this->options = array_merge([

		], $options);

	    // init
		$this->name = "Dropzone";
		$this->identifier = \Kwerqy\Ember\com\str\str::generate_id("dropzone");
		$this->buffer = \Kwerqy\Ember\com\ui\ui::make()->buffer();

	}
    //--------------------------------------------------------------------------------
	public function add_uploaded_file($filename, $options = []){

		$options = array_merge([
		    "index" => \Kwerqy\Ember\com\str\str::generate_id(),
			"filename" => $filename,
		], $options);

		$this->uploaded_files_arr[$options["index"]] = $options;
	}
	//--------------------------------------------------------------------------------
	public function build($options = []) {

		// options
		$options = array_merge([
			"label" => false,
			"id" => false,
			"folder" => false,
			"filetype_group" => \Kwerqy\Ember\com\os\filetype_group\images::make(),
			"value" => false,
			"disabled" => false,
			"data" => [],
			"/" => [],

			"crop" => false,
			"!crop" => false,
			"crop_width" => 800,
			"crop_height" => 400,

			"wrapper_height" => "200px",
			"wrapper_width" => "100%",
			"note" => true,
			"/note" => [],
			"max_files" => 5,
			"max_filesize" => 5,
			"!success" => "function(file, response){}",
			"!error" => "function(){}",
			"!complete" => "function(){}",
			"!delete" => "function(file){}",
			"required" => false,
			"help" => false,
			"wrapper_id" => false,
			"label_width" => false,
			"label_col" => false,
			"label_html" => false,
			"modal_width" => "modal-xl",

			"auto_resize_image" => false,
			"auto_resize_max_width" => false,
			"auto_resize_max_height" => false,

			"btn_only" => false,
			"hide_uploads" => false,
			"js_id" => false,
			"url" => "dropzone/xupload",
			"url_delete" => "?c=dropzone/xdelete",

  		], $options, $this->options);

		$id = $options["id"];
		if(!$options["js_id"]) $js_id = "js_{$id}";
		$url = $options["url"];
		$label = $options["label"];
		if($label === false) {
		    if($options["max_files"] == 1) $label = "Click here to upload";
            else $label = "Drop files here to upload";
        }
		$folder = $options["folder"];
		$filetype_group = $options["filetype_group"];
		$data = $options["data"];
		$wrapper_id = !$options["wrapper_id"] ? "{$js_id}_wrapper" : $options["wrapper_id"];
		$js_hidden_field = "
			$('<input>').attr({
				type: 'hidden',
				id: '{$id}['+name+']',
				name: '{$id}['+name+']',
				value: name,
				class: 'input-{$id}'
			}).appendTo('#$wrapper_id');
		";

		if(!$options["auto_resize_max_width"] && !\Kwerqy\Ember\isnull($options["auto_resize_max_width"])) $options["auto_resize_max_width"] = $options["crop_width"];
		if(!$options["auto_resize_max_height"] && !\Kwerqy\Ember\isnull($options["auto_resize_max_height"])) $options["auto_resize_max_height"] = $options["crop_height"];


		//init session
		$this->session->dropzone_id = $id;
		$this->session->element_id = $id;
		$this->session->folder = $folder;
		$this->session->filetype_group = $options["filetype_group"];
		$this->session->has_cropper = $options["crop"];
		$this->session->crop_width = $options["crop_width"];
		$this->session->crop_height = $options["crop_height"];
		$this->session->on_crop = $options["!crop"];
		$this->session->options = $options;
		$this->session->update();

		$buffer = \Kwerqy\Ember\com\ui\ui::make()->buffer();
		$buffer->div_(["@id" => $wrapper_id, "@data-session-id" => $id, ".w-100" => true]);

			$options["/"]["@id"] = $js_id;
			$options["/"][".dropzone"] = true;
			$options["/"][".disabled"] = $options["disabled"];
			$options["/"]["#height"] = $options["wrapper_height"];
			$options["/"]["#width"] = $options["wrapper_width"];

			$class_arr = \Kwerqy\Ember\com\arr\arr::extract_signature_items(".", $options);
			foreach ($class_arr as $class => $value) $options["/"][".{$class}"] = $value;

			$style_arr = \Kwerqy\Ember\com\arr\arr::extract_signature_items("#", $options);
			foreach ($style_arr as $style => $value) $options["/"]["#{$style}"] = $value;

			$buffer->div($options["/"]);

			$buffer->xihidden("dropzone_session_id[{$id}]", $id);

			if(is_string($options["note"])){
				$buffer->xnote($options["note"], array_merge([".mb-3" => false], $options["/note"]));
			}else if($options["note"] === true){
                $note_arr = [];
                if($options["max_files"] > 1) $note_arr[] = "Upload queue has been limited to {$options["max_files"]} files.";
                if($options["max_filesize"]) $note_arr[] = "Max file size: {$options["max_filesize"]}mb";

				if($note_arr) {
					$buffer->div_([".mt-2 fs-7" => true]);
						$buffer->xnote(implode(" ", $note_arr), array_merge([".mb-3" => false], $options["/note"]));
					$buffer->_div();
				}
			}


			$existing_files = [];
			foreach ($this->session->uploaded_files_arr as $index => $files){

				$name = basename($files["original"]);
				$buffer->xihidden("{$id}[$name]", $name, [".input-{$id}" => true]);

				$existing_files[$index] = [
					"filename" => basename($files["original"]),
					"name" => basename($files["original"]),
					"index" => $index,
					"size" => filesize($files["original"]),
					"path" => $files["original"],
					"type" => mime_content_type($files["original"]),
					"accepted" => true,
				];
			}
			$existing_files_json = json_encode($existing_files);

			$has_reached_max = sizeof($this->session->uploaded_files_arr) >= $options["max_files"];
			$js_options = [];
			$data = json_encode($data);
			$js_options["*url"] = $url;
			$js_options["*dictDefaultMessage"] = $label;
			$js_options["*acceptedFiles"] = str_replace("*", "", str_replace(";", ",", $filetype_group->get_flash_string()));
			$js_options["*maxFiles"] = $options["max_files"];
			$js_options["*maxFilesize"] = $options["max_filesize"];
			$js_options["*parallelUploads"] = $options["max_files"];
			$js_options["*autoProcessQueue"] = true;
			$js_options["*addRemoveLinks"] = true;

			if($options["auto_resize_image"]){
				if(!\Kwerqy\Ember\isnull($options["auto_resize_max_width"])) $js_options["*resizeWidth"] = $options["auto_resize_max_width"];
				if(!\Kwerqy\Ember\isnull($options["auto_resize_max_height"])) $js_options["*resizeHeight"] = $options["auto_resize_max_height"];
				$js_options["*resizeMethod"] = 'contain';
				$js_options["*resizeQuality"] = 1.0;

			}

			$js_options["*init"] = "!function(){
				let instance = this;
				let oncomplete = {$options["!complete"]};
				let ondelete = {$options["!delete"]};
				
				//----------------------------------------------------------------
				if($existing_files_json){
					$.each($existing_files_json, function(key,value) {
						var mockFile = value;
						instance.emit('addedfile', mockFile);
						instance.emit('thumbnail', mockFile, '".\Kwerqy\Ember\com\http\http::build_action_url("dropzone/xstream", ["session_id" => $this->session->session_id])."/id/'+value.index);
						instance.emit('complete', mockFile);
						instance.files.push(mockFile);
					});
					$('.dz-image img').css('height', '120');
					$('.dz-image img').css('width', '120');
					$('.dz-image img').css('object-fit', 'cover');
				}
				
				//----------------------------------------------------------------
				this.on('error', function(file, message) {
					if(!$('.alert-{$options["id"]}').length){
						app.browser.alert(message, 'Alert', {class: 'alert-{$options["id"]}',}); 
					}
					
					if((instance.files.length+1) >= instance.options.maxFiles){
						instance.removeFile(file);
					}
					
					let bytes = app.str.format_bytes(file.size, {symbol:false});
					let max_file_size = parseInt({$options["max_file_size"]});
					
					if(bytes >= max_file_size) instance.removeFile(file);
				});
				
				//----------------------------------------------------------------
				this.on('sending', function(file, xhr, formData) {
					
					file.index = app.util.id_generator();
					
					let formDataObj = ".json_encode($options["form_data"]).";
					formData.append('session_id', '{$this->session->session_id}');
					formData.append('filename', file.name);
					formData.append('index', file.index);
					jQuery.each( formDataObj, function( k, v ) {
						formData.append(k, v);
					});
				});
				//----------------------------------------------------------------
				this.on('queuecomplete', function(data) {
					{$this->session->dropzone_id}.update();
				});
				//----------------------------------------------------------------
				this.on('success', function (file, response) {
					let dropzone = this;
					file.session_id = '{$this->session->session_id}';
					let { type, size, session_id } = file;
					let name = file.upload ? file.upload.filename : response.uploaded_file;
					
					if(response.uploaded_file){
						name = response.uploaded_file;
					}
					
					app.form.ihidden('{$this->session->field_id}['+file.index+']', name, '#{$this->session->wrapper_id}', {class:'input-{$this->session->field_id}',});
					
					".($options["hide_uploads"] ? "this.removeAllFiles(true);" : "")."
					".($options["crop"] ? "setTimeout(function(){
						app.browser.popup('".\Kwerqy\Ember\com\http\http::build_action_url("dropzone/vcrop", ["session_id" => $this->session->session_id])."/id/'+file.index, {
							width:'{$options["modal_width"]}', 
							hide_header:true, 
							backdrop: 'static',
							on_close: function(){
								{$this->session->dropzone_id}.removeFile(file);
							}
						});
					}, 500)" : "")."
					
					$(file.previewElement).attr('data-index', file.index);
					
					$('#{$this->identifier} .dz-default.dz-message').hide();
					
					oncomplete.apply(this, [file, response]);
				});
				//----------------------------------------------------------------
				this.on('removedfile', function (file) {
					
					$('#{$this->identifier} .dz-default.dz-message').hide();
				
					$('.input-{$this->session->field_id}').each(function(index, value) {    
						let el = $(this);    
						if(el.val() === file.name){
							el.remove();
							return;
						}
					});
				
					".\Kwerqy\Ember\com\js\js::ajax(\Kwerqy\Ember\com\http\http::build_action_url("dropzone/xdelete_file"), [
						"*data" => "!{session_id:'{$this->session->session_id}', filename:file.name, index:file.index}",
						"*success" => "!ondelete.apply(this, [file])",
						"*done" => "function(response){
							setTimeout(function(){
								if(response.total_files == '0'){
									$('#{$this->identifier} .dz-default.dz-message').show();
								} 
							}, 10);
						}",
					])."
					
					{$this->session->dropzone_id}.enable();
					
				});
				//----------------------------------------------------------------
			}";

			$js_options = \Kwerqy\Ember\com\js\js::create_options(array_merge($js_options, $options["/js"]));

			$this->buffer->script(["*" => " 
				var {$this->session->dropzone_id};
				$(function(){
					{$this->session->dropzone_id} = new Dropzone('#{$this->session->dropzone_id}', $js_options);
					
					{$this->session->dropzone_id}.removeUploadedFile = function(index){
						if(this.getAcceptedFiles().length){
							$.each(this.getAcceptedFiles(), function( key, value ) {
								if(value.index == index){
									{$this->session->dropzone_id}.removeFile(value);
								}
							});
						}
					};
					
					{$this->session->dropzone_id}.update = function(index){
						if({$this->session->dropzone_id}.files.length >= {$this->session->dropzone_id}.options.maxFiles){
							this.disable();
						}
					};
					
					setTimeout(function(){
						".($options["crop"] ? "$('.dz-hidden-input').removeAttr('multiple')" : "")."
					}, 500);
				});
			"]);

			if($has_reached_max && $options["max_files"] > 1){
				$buffer->script(["*" => "
					$(function(){
						setTimeout(function(){
							$id.disable();
						}, 0);
					});
				"]);
			}
		$buffer->_div();


		return $buffer->build();
	}
	//--------------------------------------------------------------------------------
    public function __build($options = []) {

	    $options = array_merge([
		    "id" => false,
		    "url" => \Kwerqy\Ember\com\http\http::build_action_url("dropzone/xupload"),
		    "dest" => false,
		    "uploaded_files_arr" => [],
		    "max_file_size" => 4,
		    "max_files" => 5,
		    "filetype_group" => \Kwerqy\Ember\com\os\filetype_group\images::make(),

		    "hide_uploads" => false,
		    "help" => false,

		    //cropper
		    "crop" => false,
		    "crop_width" => 800,
		    "crop_height" => 400,
		    "modal_width" => "modal-xl",

		    //events
		    "!complete" => "function(file, response){}",
			"!delete" => "function(file){}",
			"form_data" => [],

		    //dropzone options
		    "/js" => [],

		    //element options
		    "/" => [
		        "@id" => $this->identifier,
                ".dropzone" => true,
            ]
		], $options);


		//init session
        $this->session = session::make(["name" => "session_dropzone_{$options["id"]}"]);

        if($options["uploaded_files_arr"]){
            $this->session->uploaded_files_arr = [];
	        foreach ($options["uploaded_files_arr"] as $uploaded_file){
	            $this->add_uploaded_file($uploaded_file);
            }
        }

        foreach ($this->uploaded_files_arr as $uploaded_file){
            $this->session->add_uploaded_file($uploaded_file["filename"], false, ["index" => $uploaded_file["index"]]);
        }
        $this->session->dropzone_id = $this->identifier;
        $this->session->field_id = $options["id"];
        $this->session->wrapper_id = "dropzone_wrapper_{$this->session->field_id}";
        $this->session->dest = $options["dest"];
        $this->session->filetype_group = $options["filetype_group"];
        $this->session->max_files = $options["max_files"];
        $this->session->max_file_size = $options["max_file_size"];
        $this->session->has_cropper = $options["crop"];
        $this->session->crop_width = $options["crop_width"];
        $this->session->crop_height = $options["crop_height"];
//        $this->session->uploaded_files_arr = [];
        $this->session->update();

		$this->buffer->div_([".dropzone-wrapper" => true, "@id" => $this->session->wrapper_id]);
            $this->buffer->div($options["/"]);
            if($options["help"]){
                if(is_string($options["help"])) $options["help"] = ["*" => $options["help"]];
                $this->buffer->span($options["help"]);
            }
		$this->buffer->_div();

		$js_options = [];
		$js_options["*url"] = $options["url"]."?session_id={$this->session->session_id}";
		$js_options["*method"] = "post";
		$js_options["*addRemoveLinks"] = true;
		$js_options["*maxFilesize"] = $this->session->max_file_size;
		$js_options["*paramName"] = "file";
		$js_options["*maxFiles"] = $this->session->max_files;
		$js_options["*acceptedFiles"] = $this->session->filetype_group->get_mime_type_str();

		$existing_files_json = json_encode($this->get_existing_session_files());

		$js_options["*init"] = "!function(){
            let instance = this;
            let oncomplete = {$options["!complete"]};
            let ondelete = {$options["!delete"]};
            
            //----------------------------------------------------------------
            if($existing_files_json){
                $.each($existing_files_json, function(key,value) {
                    var mockFile = value;
                    instance.emit('addedfile', mockFile);
                    instance.emit('thumbnail', mockFile, '".\Kwerqy\Ember\com\http\http::build_action_url("dropzone/xstream", ["session_id" => $this->session->session_id])."/id/'+value.index);
                    instance.emit('complete', mockFile);
                    instance.files.push(mockFile);
                });
                $('.dz-image img').css('height', '120');
                $('.dz-image img').css('width', '120');
                $('.dz-image img').css('object-fit', 'cover');
            }
            
            //----------------------------------------------------------------
            this.on('error', function(file, message) {
                if(!$('.alert-{$options["id"]}').length){
                    app.browser.alert(message, 'Alert', {class: 'alert-{$options["id"]}',}); 
                }
                
                if((instance.files.length+1) >= instance.options.maxFiles){
                    instance.removeFile(file);
                }
                
                let bytes = app.str.format_bytes(file.size, {symbol:false});
                let max_file_size = parseInt({$options["max_file_size"]});
                
                if(bytes >= max_file_size) instance.removeFile(file);
            });
            
            //----------------------------------------------------------------
            this.on('sending', function(file, xhr, formData) {
                
                file.index = app.util.id_generator();
                
                let formDataObj = ".json_encode($options["form_data"]).";
                formData.append('session_id', '{$this->session->session_id}');
                formData.append('filename', file.name);
                formData.append('index', file.index);
                jQuery.each( formDataObj, function( k, v ) {
                    formData.append(k, v);
                });
            });
            //----------------------------------------------------------------
            this.on('queuecomplete', function(data) {
                {$this->session->dropzone_id}.update();
            });
            //----------------------------------------------------------------
            this.on('success', function (file, response) {
                let dropzone = this;
                file.session_id = '{$this->session->session_id}';
                let { type, size, session_id } = file;
                let name = file.upload ? file.upload.filename : response.uploaded_file;
                
                if(response.uploaded_file){
                    name = response.uploaded_file;
                }
                
                app.form.ihidden('{$this->session->field_id}['+file.index+']', name, '#{$this->session->wrapper_id}', {class:'input-{$this->session->field_id}',});
                
                ".($options["hide_uploads"] ? "this.removeAllFiles(true);" : "")."
                ".($options["crop"] ? "setTimeout(function(){
                    app.browser.popup('".\Kwerqy\Ember\com\http\http::build_action_url("dropzone/vcrop", ["session_id" => $this->session->session_id])."/id/'+file.index, {
                        width:'{$options["modal_width"]}', 
                        hide_header:true, 
                        backdrop: 'static',
                        on_close: function(){
                            {$this->session->dropzone_id}.removeFile(file);
                        }
                    });
                }, 500)" : "")."
                
                $(file.previewElement).attr('data-index', file.index);
                
                $('#{$this->identifier} .dz-default.dz-message').hide();
                
                oncomplete.apply(this, [file, response]);
            });
            //----------------------------------------------------------------
            this.on('removedfile', function (file) {
                
                $('#{$this->identifier} .dz-default.dz-message').hide();
            
                $('.input-{$this->session->field_id}').each(function(index, value) {    
                    let el = $(this);    
                    if(el.val() === file.name){
                        el.remove();
                        return;
                    }
                });
            
                ".\Kwerqy\Ember\com\js\js::ajax(\Kwerqy\Ember\com\http\http::build_action_url("dropzone/xdelete_file"), [
                    "*data" => "!{session_id:'{$this->session->session_id}', filename:file.name, index:file.index}",
                    "*success" => "!ondelete.apply(this, [file])",
                    "*done" => "function(response){
                        setTimeout(function(){
                            if(response.total_files == '0'){
                                $('#{$this->identifier} .dz-default.dz-message').show();
                            } 
                        }, 10);
                    }",
                ])."
                
                {$this->session->dropzone_id}.enable();
                
            });
            //----------------------------------------------------------------
		}";

		$js_options = \Kwerqy\Ember\com\js\js::create_options(array_merge($js_options, $options["/js"]));

		$this->buffer->script(["*" => " 
		    var {$this->session->dropzone_id};
            $(function(){
                {$this->session->dropzone_id} = new Dropzone('#{$this->session->dropzone_id}', $js_options);
                
                {$this->session->dropzone_id}.removeUploadedFile = function(index){
                    if(this.getAcceptedFiles().length){
                        $.each(this.getAcceptedFiles(), function( key, value ) {
                            if(value.index == index){
                                {$this->session->dropzone_id}.removeFile(value);
                            }
                        });
                    }
                };
                
                {$this->session->dropzone_id}.update = function(index){
                    if({$this->session->dropzone_id}.files.length >= {$this->session->dropzone_id}.options.maxFiles){
                        this.disable();
                    }
                };
                
                setTimeout(function(){
                    ".($options["crop"] ? "$('.dz-hidden-input').removeAttr('multiple')" : "")."
                }, 500);
            });
		"]);

		return $this->buffer->build();

    }
	//--------------------------------------------------------------------------------
    private function get_existing_session_files() {
        $existing_files = [];
        foreach ($this->session->uploaded_files_arr as $index => $files){

            $name = basename($files["original"]);
            $this->buffer->xihidden("{$this->session->field_id}[$name]", $name, [".input-{$this->session->field_id}" => true]);

            $existing_files[$index] = [
                "filename" => basename($files["original"]),
                "name" => basename($files["original"]),
                "id" => $index,
                "index" => $index,
                "size" => filesize($files["original"]),
                "path" => $files["original"],
                "type" => mime_content_type($files["original"]),
                "accepted" => true,
            ];
        }
        return $existing_files;
    }
	//--------------------------------------------------------------------------------
}