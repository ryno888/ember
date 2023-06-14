<?php

namespace App\Controllers;

class Stream extends BaseController {
	//--------------------------------------------------------------------------------
	private function stream_file($filename, $options = []){
		$options = array_merge([
		    "download" => false,
		    "cache" => true,
		], $options);

		\Kwerqy\Ember\com\http\http::stream_file($filename, $options);

	}
	//--------------------------------------------------------------------------------
	private function is_download(&$filename_arr = []){

		$download = reset($filename_arr) == "download";
		if($download) array_shift($filename_arr);

		return $download;
	}
	//--------------------------------------------------------------------------------
	public function xasset(...$filename_arr) {

	    $this->response->setContentType('Content-Type: application/json');

		$options = [];
		$options["download"] = $this->is_download($filename_arr);
		$this->stream_file(DIR_WRITABLE."/cache/".implode("/", $filename_arr), $options);

	}
	//--------------------------------------------------------------------------------
	public function xstream(...$filename_arr) {

	    $this->response->setContentType('Content-Type: application/json');

	    $id = reset($filename_arr);

	    $filename = \Kwerqy\Ember\com\str\str::decrypt_url_r($id);

		$options = [];
		$options["download"] = $this->is_download($filename_arr);
		$this->stream_file($filename, $options);
	}
	//--------------------------------------------------------------------------------
	public function xtemp(...$filename_arr) {

	    $this->response->setContentType('Content-Type: application/json');

		\Kwerqy\Ember\com\http\http::stream_file(DIR_TEMP."/".implode("/", $filename_arr));
	}
	//--------------------------------------------------------------------------------
}
