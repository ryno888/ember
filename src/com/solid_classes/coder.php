<?php

namespace Kwerqy\Ember\com\solid_classes;

/**
 * @package mod\solid_classes
 * @author Ryno Van Zyl
 */
class coder extends \Kwerqy\Ember\com\intf\standard {
	//--------------------------------------------------------------------------------
	public function loop_solid_classes($fn) {

	    foreach (glob(DIR_COM."/solid_classes/*") as $key => $directory){
	        if(is_dir($directory) && !in_array(basename($directory), ["intf"])) {
	            $dirmap = directory_map($directory);
                $category = basename($directory);
	            foreach ($dirmap as $key => $solid_class){
                    if(!is_array($solid_class)){
                        $class_name = "\\Kwerqy\\Ember\\com\\solid_classes\\{$category}\\".(str_replace(".php", "", $solid_class));
                        call_user_func($fn, $class_name, "{$directory}/{$solid_class}");
                    }
                }
            }
        }
	}
	//--------------------------------------------------------------------------------
	/**
	 * @return array
	 */
	public function get_constant_arr(): array {
		$constant_arr = [];
		$this->loop_solid_classes(function($class_name, $filename) use(&$constant_arr){
			$category = $filename;
			$category_parts = explode("/", $category);
			$category = $category_parts[sizeof($category_parts)-2];

			$solid = helper::make()->get_from_classname($class_name);
			if($solid instanceof \Kwerqy\Ember\com\solid_classes\intf\dbrow){
				$value = $solid->get_key();
			}else if($solid instanceof \Kwerqy\Ember\com\solid_classes\intf\standard){
				$value = $solid->get_value();
			}


			$constant_arr[strtoupper($category)][$solid->get_code()] = [
				"classname" => $class_name,
				"filename" => $filename,
				"constant" => $solid->get_code(),
				"value" => $value,
				"category" => strtoupper($category),
				"description" => $solid->get_description(),
			];
		});

		return $constant_arr;
	}
	//--------------------------------------------------------------------------------
	public function build_constants() {

		$constants_str = $this->get_constants_arr_string();

		if ($constants_str) {
			$dir = APPPATH . "Libraries/incl";
			$filename = "generated_constants.php";

			$constant_str = implode("\n", $constants_str);

			$content = <<<EOD
<?php
namespace incl;

/**
 * @package mod\solid_classes
 * @author Ryno Van Zyl
 */

$constant_str


EOD;

			\Kwerqy\Ember\com\os\os::mkdir($dir);
			file_put_contents("$dir/$filename", $content);
		}

	}
	//--------------------------------------------------------------------------------
	private function get_constants_arr_string() {

		$return_arr = [];
		$constant_arr = $this->get_constant_arr();

		foreach ($constant_arr as $category => $constant_data_arr) {

			$return_arr[] = <<<EOD
//-------------------------------------------------------------
//{$category}
//-------------------------------------------------------------
EOD;
			foreach ($constant_data_arr as $constant => $data) {
				$return_arr[] = "/**
 * {$constant}
 * {$data["description"]}
 */";
				$return_arr[] = "if(!defined(\"{$constant}\")) define(\"{$constant}\", \"{$data["value"]}\");";
			}

		}

		return $return_arr;

	}
	//--------------------------------------------------------------------------------
	public function build_library() {

		$constant_arr = $this->get_constant_arr();

		if ($constant_arr) {
			$dir = APPPATH . "Libraries/incl";
			$filename = "library.php";

			$content_arr= [];

			foreach ($constant_arr as $category => $constant_data_arr) {

				foreach ($constant_data_arr as $constant => $data) {

					$classname = str_replace("\\", "\\\\", $data["classname"]);
					$content_arr[] = <<<EOD
		"$constant" => [
			"classname" => "{$classname}",
			"filename" => "{$data["filename"]}",
			"constant" => "{$data["constant"]}",
			"value" => "{$data["value"]}",
			"category" => "{$data["category"]}",
		],
EOD;


					$return_arr[] = "if(!defined(\"{$constant}\")) define(\"{$constant}\", {$data["value"]});";
				}

			}

			$content_str = implode("\n", $content_arr);

			$content = <<<EOD
<?php
namespace incl;

/**
 * @package mod\solid_classes
 * @author Ryno Van Zyl
 */

class library extends \Kwerqy\Ember\com\intf\standard {

	public static \$index_arr = [
		$content_str
	];

}


EOD;
            \Kwerqy\Ember\com\os\os::mkdir($dir);
			file_put_contents("$dir/$filename", $content);
		}

	}
	//--------------------------------------------------------------------------------
}