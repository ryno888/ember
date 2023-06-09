<?php

namespace Kwerqy\Ember\com\db\coder;

/**
 * @package mod\debug
 * @author Ryno Van Zyl
 */
class db_to_php extends \Kwerqy\Ember\com\intf\standard {

    /**
     * @var \Kwerqy\Ember\com\db\meta|\Kwerqy\Ember\com\intf\standard
     */
    protected $meta;

    //--------------------------------------------------------------------------------
    protected function __construct($options = []) {
        $this->meta = \Kwerqy\Ember\com\db\meta::make();
    }

    //--------------------------------------------------------------------------------
	public function run() {
		foreach ($this->meta->get_tables() as $table){

			$field_data_arr = $this->meta->get_table_fields($table);
			$first_field = reset($field_data_arr);
			$prefix = substr($first_field->name, 0, 3);

			$coder = coder::make();
			$coder->set_prefix($prefix);
			$coder->set_key("{$prefix}_id");
			$coder->set_name($table);
			$coder->set_display_name(\Kwerqy\Ember\com\str\str::propercase(str_replace("_", " ", $table)));
			$coder->set_display_field("{$prefix}_");

			foreach ($field_data_arr as $field_data){
				$display_name = \Kwerqy\Ember\com\str\str::propercase(str_replace("_", " ", str_replace("{$prefix}_", "", $field_data->name)));
				$type = strtoupper("TYPE_{$field_data->type}");
				$default = is_null($field_data->default) ? "null" : $field_data->default;
				$reference = strpos($field_data->name, "{$prefix}_ref") !== false ? str_replace("{$prefix}_ref_", "", '"'.$field_data->name.'"') : null;
				$coder->add_field($field_data->name, $display_name, $type, $default, $reference);
			}

			$this->build($coder);
		}
	}
	//--------------------------------------------------------------------------------

    /**
     * @param $coder coder
     * @param array $options
     */
	public function build($coder, $options = []) {

	    $field_str_arr = [];

		foreach ($coder->get_field_arr() as $field_data){
			$field_str_arr[] = "\"{$field_data["name"]}\"			=> array(\"{$field_data["display_name"]}\"		, \"{$field_data["default"]}\", {$field_data["type"]}, {$field_data["reference"]}),";
		}

		$field_str = implode("\n", $field_str_arr);

		$content = <<<EOD
<?php
/**
 * @package db
 * @author Ryno Van Zyl
 */
class {$coder->get_name()} extends \\Kwerqy\\Ember\\com\\db\\intf\\table {
	//--------------------------------------------------------------------------------
	// properties
	//--------------------------------------------------------------------------------
	public string \$name = "{$coder->get_name()}";
	public string \$key = "{$coder->get_key()}";
	public string \$display = "{$coder->get_display_field()}";

	public string \$display_name = "{$coder->get_display_name()}";

	public array \$field_arr = array( // FIELDNAME => DISPLAY[0] DEFAULT[1] TYPE[2] REFERENCE[3]
		{$field_str}
	);
 	//--------------------------------------------------------------------------------
}
EOD;

		$filename = DIR_ROOT."/app/db/{$coder->get_name()}.php";
		if(file_exists($filename)) return;

		\Kwerqy\Ember\com\os\os::mkdir(dirname($filename));
		file_put_contents($filename, $content);
	    
	}
	//--------------------------------------------------------------------------------
}