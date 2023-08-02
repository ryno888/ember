<?php

namespace Kwerqy\Ember\com\debug;

/**
 * @package mod\debug
 * @author Ryno Van Zyl
 */
class debug {
	//--------------------------------------------------------------------------------
	// static
	//--------------------------------------------------------------------------------
	/**
	 * Displays the given variable inside a pre formatted html block perserving end lines.
	 * Has special support for the \mod\db\row class by not displaying the db and _original
	 * properties.
	 *
	 * @param mixed $var <p>The variable to display.</p>
	 *
	 * @param boolean $options[show_detail] <p>Should type information be added.</p>
	 */
	public static function view($var, $options = []) {
		// options
		$options = array_merge([
			"show_detail" => false,
			"no_formatting" => false,
		], $options);

		// show variable value
		if (!$options["no_formatting"]) echo "<pre>";
		if ($options["show_detail"]) var_dump($var);
		else print_r($var);
		if (!$options["no_formatting"])echo "</pre>";

	}
	//--------------------------------------------------------------------------------
	/**
	 * Writes the given variable to a file named console.txt in the temp folder. Will
	 * not overwrite the file, but append with each call. Has special support for the
	 * \mod\db\row class by not displaying the db and _original properties.
	 *
	 * @param mixed $var <p>The variable to display.</p>
	 *
	 * @param boolean $options[show_detail] <p>Should type information be added.</p>
	 */
	public static function console($var, $options = []) {
		// options
		$options = array_merge([
			"show_detail" => false,
			"no_formatting" => true,
		], $options);

		// buffer results to write to file later
		\Kwerqy\Ember\com\os\os::mkdir(DIR_TEMP);
		ob_start();
		self::view($var, $options);
		file_put_contents(DIR_TEMP."/console.txt", ob_get_clean().PHP_EOL, FILE_APPEND);
	}
	//--------------------------------------------------------------------------------
	/**
	 * Returns a stack trace from the current point in the code.
	 *
	 * @param int $options[count] <p>How many levels should the trace report.</p>
	 */
	public static function trace($options = []) {
		// options
		$options = array_merge([
			"count" => 20,
		], $options);

		// get the stack trace
		$trace_arr = array_reverse(array_slice(debug_backtrace(), 0, $options["count"]));
		$trace = PHP_EOL.\Kwerqy\Ember\com\http\http::get_url();
		foreach ($trace_arr as $trace_index => $trace_item) {
			// we only want a certain amount of items
			if ($trace_index >= $options["count"]) break;

			$trace .= PHP_EOL.str_repeat(" ", $trace_index * 4);

			// file and line
			if (isset($trace_item["file"])) {
				$filename = basename($trace_item["file"]);
				$trace .= " -- {$filename} ({$trace_item["line"]}) ";
			}
			else $trace .= " -- CALLBACK# ";

			// class
			if (isset($trace_item["class"])) $trace .= "{$trace_item["class"]}{$trace_item["type"]}";

			// function
			$trace .= "{$trace_item["function"]}()";

		}

		// done
		return $trace;
	}
	//--------------------------------------------------------------------------------
}