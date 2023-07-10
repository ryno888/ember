<?php

namespace Kwerqy\Ember\com\incl\dropzone;

class session extends \Kwerqy\Ember\com\session\intf\session_helper {
    //--------------------------------------------------------------------------------
	public $field_id;
	public $wrapper_id;
	public $session_id;
	public $dest;
	public $uploaded_files_arr = [];

	public $max_files;
	public $max_file_size;

	public $dropzone_id;
	public $element_id;
	public $folder;
	public $filetype_group;

	public $has_cropper = false;
	public $crop_width = 800;
	public $crop_height = 400;

	public $options = [];
    //--------------------------------------------------------------------------------
    protected function __construct($options = []) {
        parent::__construct($options);

        $this->session_id = $options["name"];

    }
    //--------------------------------------------------------------------------------
	public function add_uploaded_file($filename, $cropped_filename = false, $options = []){

		$options = array_merge([
		    "index" => false,
			"original" => $filename,
			"cropped" => $cropped_filename,
		], $options);

		$this->uploaded_files_arr[$options["index"]] = $options;
	}
	//--------------------------------------------------------------------------------
	public function get_uploaded_file($index, $sub_index = false){

		if(isset($this->uploaded_files_arr[$index])){
			$result = $this->uploaded_files_arr[$index];
			if($sub_index && isset($result[$sub_index])) return $result[$sub_index];
			return $result;
		}
	}
	//--------------------------------------------------------------------------------
	public function remove_uploaded_file($index){
		if(isset($this->uploaded_files_arr[$index])){
			$data_arr = $this->uploaded_files_arr[$index];
			foreach ($data_arr as $file){
				if($file) $this->delete_file($file);
			}
			unset($this->uploaded_files_arr[$index]);
		}
	}
	//--------------------------------------------------------------------------------
	private function delete_file($filename) {
		//delete original
		if(file_exists($filename))
			@unlink($filename);
	}
    //--------------------------------------------------------------------------------
}