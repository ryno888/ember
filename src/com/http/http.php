<?php

namespace Kwerqy\Ember\com\http;

/**
 * @package com
 * @author Ryno Van Zyl
 */
class http {
	//--------------------------------------------------------------------------------
	public static function stream_file($filename, $options = []) {
		// options
		$options = array_merge([
			"filename" => basename($filename),
			"download" => true,
			"cache" => true,
		], $options);

		if($options["cache"] && $options["download"]) $options["cache"] = false;

		// check if our file exists
		if (!file_exists($filename)) return;

		self::add_cache_headers($filename, $options);

		// stream
        $mime = mime_content_type($filename); //<-- detect file type
        header('Content-Length: '.filesize($filename)); //<-- sends filesize header
        header("Content-Type: $mime"); //<-- send mime-type header
        header('Content-Disposition: inline; filename="'.$filename.'";'); //<-- sends filename header

        if ($options["download"]) {
			header('Content-Disposition: attachment; filename="'.$filename.'"');
		}

        readfile($filename); //<--reads and outputs the file onto the output buffer
        exit(); // or die()
	}
	//--------------------------------------------------------------------------------
	public static function stream($data, $filename, $options = []) {
		// options
		$options = array_merge([
			"download" => true,
			"cache" => true,
		], $options);

		if($options["cache"]) self::add_cache_headers($filename, $options);
		else self::add_stream_headers($filename, $options);

		try{
            if (is_resource($data)) {
                while (!feof($data)) {
                    echo fread($data, 8192);
                    ob_flush();
                }
            }
            else {
                echo $data;
            }
		}catch(\Exception $ex){

		}
	}
	//--------------------------------------------------------------------------------
    public static function add_stream_headers($filename, $options = []) {
		// options
		$options = array_merge([
			"download" => true,
		], $options);

    	// clear output buffer
		if (ob_get_level()) ob_end_clean();

		// add stream headers
		header("Pragma: public");
		header("Cache-Control: public");
		header("Content-Description: File Transfer");
		header("Content-Transfer-Encoding: binary");
		header("HTTP/1.1 200 OK");

		 // content-type
		$content_type = self::get_mime_type(pathinfo($filename, PATHINFO_EXTENSION));
		header("Content-Type: {$content_type}");

		if ($options["download"]) {
			header('Content-Disposition: attachment; filename="'.$filename.'"');
		}
    }
    //--------------------------------------------------------------------------------
    public static function add_cache_headers($filename, $options = []) {

        // options
		$options = array_merge([
			"download" => true,
		], $options);

    	// clear output buffer
		if (ob_get_level()) ob_end_clean();

		// add stream headers
		header("Pragma: public");
		header('Cache-Control: public');
        header("Cache-Control: max-age=".((60*60*24*365)));

        $timestamp = strtotime("now + 1 week");
        $gmt_mtime = gmdate('r', $timestamp);

        header('ETag: "'.md5($timestamp.$filename).'"');
        header('Expires: '.  gmdate('r', strtotime("now") + (60*60*24*365)));

		header("Content-Description: File Transfer");
		header("Content-Transfer-Encoding: binary");
		header("HTTP/1.1 200 OK");

		 // content-type
		$content_type = self::get_mime_type(pathinfo($filename, PATHINFO_EXTENSION));
		header("Content-Type: {$content_type}");

		if(isset($_SERVER['HTTP_IF_MODIFIED_SINCE']) || isset($_SERVER['HTTP_IF_NONE_MATCH'])) {
            if (isset($_SERVER['HTTP_IF_MODIFIED_SINCE']) && $_SERVER['HTTP_IF_MODIFIED_SINCE'] == $gmt_mtime) {
                header('HTTP/1.1 304 Not Modified');
                exit();
            }
            if (isset($_SERVER['HTTP_IF_NONE_MATCH']) && str_replace('"', '', stripslashes($_SERVER['HTTP_IF_NONE_MATCH'])) == md5($timestamp.$filename)) {
                header('HTTP/1.1 304 Not Modified');
                exit();
            }
        }

        if ($options["download"]) {
			header('Content-Disposition: attachment; filename="'.$filename.'"');
		}

		if ($options["download"]) {
			header('Content-Disposition: attachment; filename="'.$filename.'"');
		}

	}
    //--------------------------------------------------------------------------------
	public static function get_mime_type($extension) {
		static $type_arr = [
			"css" => "text/css",
			"csv" => "text/csv",
			"gif" => "image/gif",
			"gz" => "text/html",
			"html" => "text/html",
			"ico" => "image/x-icon",
			"jpg" => "image/jpeg",
			"jpeg" => "image/jpeg",
			"js" => "text/javascript",
			"mp3" => "audio/mpeg",
			"ogg" => "audio/ogg",
			"png" => "image/png",
			"xls" => "application/vnd.ms-excel",
			"xlsx" => "application/vnd.openxmlformats-officedocument.spreadsheetml.sheet",
			"wav" => "audio/wav",
			"zip" => "application/zip",
			"pdf" => "application/pdf",
		];

		if (isset($type_arr[$extension])) return $type_arr[$extension];
		else return "application/octet-stream";
	}
	//--------------------------------------------------------------------------------
	public static function build_url($data = [], $options = []) {
		$options = array_merge([
		    "secure" => false,
		], $options);

		return prep_url(site_url($data), \Kwerqy\Ember\Ember::$app->forceGlobalSecureRequests);
	}
	//--------------------------------------------------------------------------------

    /**
     * @param $nr
     * @param array $options
     * @return string
     */
	public static function go_error($nr, $options = []): string {

		$url = self::get_error_url($nr, $options);

		return self::redirect($url, ["wrap" => false]);
	}
	//--------------------------------------------------------------------------------
	public static function get_error_url($nr, $options = []){

	    $options = array_merge([
	        "layout" => "website",
	    ], $options);

		$solid_helper = \Kwerqy\Ember\com\solid_classes\helper::make()->get("error", "error_code_{$nr}");

		$control = [];
		if($options["layout"]) $control[] = $options["layout"];
		$control[] = "error";

		return self::build_action_url(implode("/", $control), ["code" => strtolower($solid_helper->get_code())]);
    }
	//--------------------------------------------------------------------------------

    /**
     * @param $nr
     * @param array $options
     * @return string
     */
	public static function go_message($nr, $options = []): string {

		$url = self::get_message_url($nr, $options);

		return self::redirect($url, ["wrap" => false]);
	}
	//--------------------------------------------------------------------------------
	public static function get_message_url($nr, $options = []){

	    $options = array_merge([
	        "layout" => "website",
	    ], $options);

	    $solid_helper = \Kwerqy\Ember\com\solid_classes\helper::make()->get("message", "message_code_{$nr}");

		$control = [];
		if($options["layout"]) $control[] = $options["layout"];
		$control[] = "message";

		return self::build_action_url(implode("/", $control), ["code" => strtolower($solid_helper->get_code())]);
    }
	//--------------------------------------------------------------------------------
	/**
	 * @return string
	 */
	public static function go_home() {

		if(http::is_ajax()){
			return self::ajax_response(["redirect" => self::build_action_url("website/index/home")]);
		}else{
			self::redirect("website/index/home");
		}
	}
	//--------------------------------------------------------------------------------
	public static function is_valid_form_submit(): bool {
		$id = \Kwerqy\Ember\Ember::get_env("honeypot.name", ["default" => "security_field"]);
		$value = \Kwerqy\Ember\Ember::$request->get($id, TYPE_STRING);

		if(strlen($value) > 0) return false;

		 return true;
	}
	//--------------------------------------------------------------------------------
	public static function is_ajax(): bool {
		return \Kwerqy\Ember\com\request\request::make()->is_ajax();
	}
	//--------------------------------------------------------------------------------

    /**
     * @param $url
     * @param array $options
     * @return string
     */
	public static function redirect($url, $options = []): string {
	    $options = array_merge([
	        "wrap" => true
	    ], $options);

	    if($options["wrap"])
	        $url = self::build_action_url($url);

		header("Location:".$url);
		exit();
	}
	//--------------------------------------------------------------------------------
	public static function build_action_url($control, $data = []) {

		$parts = [];
		if(is_array($control)) $parts["control"] = implode("/", $control);
		else $parts["control"] = $control;

		$data = \Kwerqy\Ember\com\arr\arr::splat($data);

		if($data){
			$key = key($data);
			$value = reset($data);
			if(sizeof($data) == 1 && $key === 0){
				$parts[] = "id";
				$parts[] = $value;
			}else{
				array_walk($data, function($value, $key)use(&$parts){
					$parts[] = $key;
					$parts[] = $value;
				});
			}
		}

		return self::build_url($parts);

	}
	//--------------------------------------------------------------------------------
	public static function get_control($options = []) {

		$options = array_merge([
		    "separator" => "/"
		], $options);

		$parts = explode("/", uri_string());

		if(!$options["separator"]) return $parts;

		return implode($options["separator"], $parts);

	}
	//--------------------------------------------------------------------------------
    public static function get_current_controller() {
        $router = service('router');
        return $router->controllerName();
    }
	//--------------------------------------------------------------------------------
    public static function get_current_view() {
        $router = service('router');
        $params = $router->params();
        return end($params);
    }
	//--------------------------------------------------------------------------------
    public static function get_current_method() {
        $router = service('router');
        return $router->methodName();
    }
	//--------------------------------------------------------------------------------
    public static function is_mobile() {
        $useragent=$_SERVER['HTTP_USER_AGENT'];
        return (preg_match('/(android|bb\d+|meego).+mobile|avantgo|bada\/|blackberry|blazer|compal|elaine|fennec|hiptop|iemobile|ip(hone|od)|iris|kindle|lge |maemo|midp|mmp|netfront|opera m(ob|in)i|palm( os)?|phone|p(ixi|re)\/|plucker|pocket|psp|series(4|6)0|symbian|treo|up\.(browser|link)|vodafone|wap|windows (ce|phone)|xda|xiino/i',$useragent)||preg_match('/1207|6310|6590|3gso|4thp|50[1-6]i|770s|802s|a wa|abac|ac(er|oo|s\-)|ai(ko|rn)|al(av|ca|co)|amoi|an(ex|ny|yw)|aptu|ar(ch|go)|as(te|us)|attw|au(di|\-m|r |s )|avan|be(ck|ll|nq)|bi(lb|rd)|bl(ac|az)|br(e|v)w|bumb|bw\-(n|u)|c55\/|capi|ccwa|cdm\-|cell|chtm|cldc|cmd\-|co(mp|nd)|craw|da(it|ll|ng)|dbte|dc\-s|devi|dica|dmob|do(c|p)o|ds(12|\-d)|el(49|ai)|em(l2|ul)|er(ic|k0)|esl8|ez([4-7]0|os|wa|ze)|fetc|fly(\-|_)|g1 u|g560|gene|gf\-5|g\-mo|go(\.w|od)|gr(ad|un)|haie|hcit|hd\-(m|p|t)|hei\-|hi(pt|ta)|hp( i|ip)|hs\-c|ht(c(\-| |_|a|g|p|s|t)|tp)|hu(aw|tc)|i\-(20|go|ma)|i230|iac( |\-|\/)|ibro|idea|ig01|ikom|im1k|inno|ipaq|iris|ja(t|v)a|jbro|jemu|jigs|kddi|keji|kgt( |\/)|klon|kpt |kwc\-|kyo(c|k)|le(no|xi)|lg( g|\/(k|l|u)|50|54|\-[a-w])|libw|lynx|m1\-w|m3ga|m50\/|ma(te|ui|xo)|mc(01|21|ca)|m\-cr|me(rc|ri)|mi(o8|oa|ts)|mmef|mo(01|02|bi|de|do|t(\-| |o|v)|zz)|mt(50|p1|v )|mwbp|mywa|n10[0-2]|n20[2-3]|n30(0|2)|n50(0|2|5)|n7(0(0|1)|10)|ne((c|m)\-|on|tf|wf|wg|wt)|nok(6|i)|nzph|o2im|op(ti|wv)|oran|owg1|p800|pan(a|d|t)|pdxg|pg(13|\-([1-8]|c))|phil|pire|pl(ay|uc)|pn\-2|po(ck|rt|se)|prox|psio|pt\-g|qa\-a|qc(07|12|21|32|60|\-[2-7]|i\-)|qtek|r380|r600|raks|rim9|ro(ve|zo)|s55\/|sa(ge|ma|mm|ms|ny|va)|sc(01|h\-|oo|p\-)|sdk\/|se(c(\-|0|1)|47|mc|nd|ri)|sgh\-|shar|sie(\-|m)|sk\-0|sl(45|id)|sm(al|ar|b3|it|t5)|so(ft|ny)|sp(01|h\-|v\-|v )|sy(01|mb)|t2(18|50)|t6(00|10|18)|ta(gt|lk)|tcl\-|tdg\-|tel(i|m)|tim\-|t\-mo|to(pl|sh)|ts(70|m\-|m3|m5)|tx\-9|up(\.b|g1|si)|utst|v400|v750|veri|vi(rg|te)|vk(40|5[0-3]|\-v)|vm40|voda|vulc|vx(52|53|60|61|70|80|81|83|85|98)|w3c(\-| )|webc|whit|wi(g |nc|nw)|wmlb|wonu|x700|yas\-|your|zeto|zte\-/i',substr($useragent,0,4)));
    }
	//--------------------------------------------------------------------------------
	/**
	 * @param false $current_url
	 * @param array $options
	 * @return array
	 */
	public static function get_parameters($current_url = false, $options = []) {

		$options = array_merge([
		], $options);


		$uri = \Config\Services::uri();


		$segment_arr = array_reverse($uri->getSegments());

		$params = [];
		foreach ($segment_arr as $key => $value) {
            if ($key % 2 === 0) {
                if(isset($segment_arr[$key + 1]))
                    $params[$segment_arr[$key + 1]] = $value;
            }
		}

		return $params;
	}
	//--------------------------------------------------------------------------------
    public static function get_stream_url($mixed, $options = []){

        $options = array_merge([
            "id" => false,
            "absolute" => false,
            "filename" => is_string($mixed) ? basename($mixed) : false,
        ], $options);

        if(!$options["id"]){
            $options["id"] = \Kwerqy\Ember\com\str\str::encrypt_url_r($mixed);
        }

        $url = [];
        $url[] = site_url(["stream", "xstream", $options["id"]]);
        if($options["filename"]) $url[] = "?filename={$options["filename"]}";

        return implode("", $url);
    }
	//--------------------------------------------------------------------------------

    /**
     * @return bool
     */
    public static function is_panel_request() {

        $p = \Kwerqy\Ember\Ember::$request->get_get("p", TYPE_STRING);
        $ui_table = \Kwerqy\Ember\Ember::$request->get_get("ui_table", TYPE_STRING);

        return ($p || $ui_table);
    }
	//--------------------------------------------------------------------------------
	public static function json($var) {
		// set correct mime type
		header("Content-Type: application/json");

		// encode and print variable
    	echo json_encode($var);
    	exit();
	}
	//--------------------------------------------------------------------------------
    /**
     * @param array $options = [
     *      'redirect' => 'an url to redirect to'
     *      'message' => 'a message to show in an alert popup'
     *      'refresh' => 'boolean - refresh the current page'
     *      'popup' => 'an url to create a popup with'
     *      'js' => 'custom js to trigger'
     * ]
     * @return string
     */
    public static function ajax_response($options = []) {

        $options = array_merge([
        	"code" => isset($options["errors"]) && $options["errors"] ? 1 : 0,
            "errors" => [],
            "redirect" => false,
            "alert" => false,
            "message" => false,
            "title" => false,
            "ok_callback" => false,
            "refresh" => false,
            "popup" => false,
            "notice" => false,
            "notice_color" => "info",
            "js" => false,
        ], $options);


		return self::json($options);
    }
    //--------------------------------------------------------------------------------
	public static function get_content_security_policy($policy_arr) {
		// init
		$header = "";

		// build securoty policy header
		foreach ($policy_arr as $policy_index => $policy_item) {
			$header .= "{$policy_index} 'self' ";
			foreach ($policy_item as $policy_item_item) {
				$header .= " {$policy_item_item}";
			}
			$header .= ";";
		}

		// done
		return "Content-Security-Policy: {$header}";
	}
	//--------------------------------------------------------------------------------
	public static function is_valid_email($email){

        if(!$email)
            return false;

        if(!filter_var($email, FILTER_VALIDATE_EMAIL))
            return false;

        if(!preg_match("/^[a-zA-Z0-9_.-]+@[a-zA-Z0-9-]+.[a-zA-Z0-9-.]+$/", $email))
            return false;

        $email_arr = explode("@", $email);
        if (!checkdnsrr(array_pop($email_arr), "MX")) {
            return false;
        }

		return true;
	}
	//--------------------------------------------------------------------------------
}