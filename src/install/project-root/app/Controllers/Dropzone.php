<?php

namespace App\Controllers;

class Dropzone extends BaseController {
	//---------------------------------------------------------------------------------------
    public function xupload() {

        $session_id = \Kwerqy\Ember\Ember::$request->get_get("session_id", TYPE_STRING);
        $index = \Kwerqy\Ember\Ember::$request->get_trusted("index", TYPE_STRING);


        if(!isset($_FILES["file"]["name"]))
			throw new \Exception("Error uploading file");

		if(!$session_id){
			throw new \Exception("Invalid id");
		}

		//init session
        $session = \Kwerqy\Ember\com\incl\dropzone\session::make(["name" => $session_id]);


		//build file info
		$pathinfo = pathinfo(strtolower($_FILES["file"]["name"]));
		$pathinfo["filename"] = \Kwerqy\Ember\com\data\data::parse($pathinfo["filename"], TYPE_FILE);
		$pathinfo["basename"] = \Kwerqy\Ember\com\data\data::parse($pathinfo["basename"], TYPE_FILE);

		// check that folder exists
		\Kwerqy\Ember\com\os\os::mkdir($session->dest);

		//check that the extension is allowed
		if (isset($pathinfo["extension"])) $pathinfo["extension"] = strtolower($pathinfo["extension"]);
		if (!isset($pathinfo["extension"]) || !$session->filetype_group->has_extension($pathinfo["extension"])) {
		    throw new \Exception("File extension not allowed: {$pathinfo["extension"]}");
		}

		// move uploaded file
		$filepath = "{$session->dest}/{$pathinfo["filename"]}.{$pathinfo["extension"]}";

		if(file_exists($filepath))
		    $filepath = "{$session->dest}/{$pathinfo["filename"]}_".time().".{$pathinfo["extension"]}";

		//move the uploaded file
		move_uploaded_file($_FILES["file"]["tmp_name"], $filepath);

		$session->add_uploaded_file($filepath, false, ["index" => $index]);
		$session->update();

    }
	//--------------------------------------------------------------------------------
    public function xstream() {

        $this->response->setContentType('Content-Type: application/json');

        $file_index = \Kwerqy\Ember\Ember::$request->get("id");
        $session_id = \Kwerqy\Ember\Ember::$request->get("session_id");

        //init session
        $session = \Kwerqy\Ember\com\incl\dropzone\session::make(["name" => $session_id]);
        $item = $session->get_uploaded_file($file_index);
        $filename = isset($item["original"]) ? $item["original"] : false;

	    if($filename && file_exists($filename)){
	        \Kwerqy\Ember\com\http\http::stream_file($filename, ["filename" => basename($filename), "download" => false]);
        }
    }
	//--------------------------------------------------------------------------------
    public function xdelete_file() {

        $this->response->setContentType('Content-Type: application/json');

        $file_index = \Kwerqy\Ember\Ember::$request->get("index");
        $session_id = \Kwerqy\Ember\Ember::$request->get("session_id");

        //init session
        $session = \Kwerqy\Ember\com\incl\dropzone\session::make(["name" => $session_id]);
        $session->remove_uploaded_file($file_index);
        $session->update();

        return \Kwerqy\Ember\com\http\http::ajax_response(["total_files" => sizeof($session->uploaded_files_arr)]);
    }
	//--------------------------------------------------------------------------------
    public function xcrop() {

        $this->response->setContentType('Content-Type: application/json');

        $file_index = \Kwerqy\Ember\Ember::$request->get("file_index");
        $session_id = \Kwerqy\Ember\Ember::$request->get("session_id");

		if(!$session_id){
		    trigger_error("Invalid id", E_ERROR);
			\Kwerqy\Ember\com\http\http::json([ "code" => 3, "message" => "Access denied",]);
			return "stream";
		}

        //init session
        $session = \Kwerqy\Ember\com\incl\dropzone\session::make(["name" => $session_id]);

		//params
		$filename = $session->get_uploaded_file($file_index, "original");

		$result =  \Kwerqy\Ember\com\incl\dropzone\crop_helper::make()->xcrop($filename);
		$session->add_uploaded_file($result["original"], $result["cropped"], ["index" => $file_index]);
		$session->update();

		return \Kwerqy\Ember\com\http\http::ajax_response($session->uploaded_files_arr);


    }
	//--------------------------------------------------------------------------------
    public function vcrop($data) {

        $file_index = \Kwerqy\Ember\Ember::$request->get("id");
        $session_id = \Kwerqy\Ember\Ember::$request->get("session_id");
        $session = \Kwerqy\Ember\com\incl\dropzone\session::make(["name" => $session_id]);

        return \Kwerqy\Ember\com\ui\ui::make()->ci_controller("dropzone", "vcrop", [
            "data" => [
                "session" => $session,
                "file_index" => $file_index,
            ],
            "pre_layout" => [],
            "post_layout" => [],
        ]);
    }
	//--------------------------------------------------------------------------------
}
