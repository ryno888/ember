<?php

/**
 * The goal of this file is to allow developers a location
 * where they can overwrite core procedural functions and
 * replace them with their own. This file is loaded during
 * the bootstrap process and is called during the frameworks
 * execution.
 *
 * This can be looked at as a `master helper` file that is
 * loaded early on, and may also contain additional functions
 * that you'd like to use throughout your entire application
 *
 * @see: https://codeigniter4.github.io/CodeIgniter4/
 * @param $mixed
 * @param bool $show_detail
 * @param array $options
 */

//--------------------------------------------------------------------------------
function console($mixed, $show_detail = false, $options = []) {
    $options = array_merge([
        "show_detail" => $show_detail,
    ], $options);
    \Kwerqy\Ember\Ember::console($mixed, $options);
}
//--------------------------------------------------------------------------------
function display($mixed, $show_detail = false, $options = []) {
    $options = array_merge([
        "show_detail" => $show_detail,
    ], $options);
    \Kwerqy\Ember\com\debug\debug::view($mixed, $options);
}
//--------------------------------------------------------------------------------
function dbvalue($value, $options = []) {
    return \Kwerqy\Ember\com\db\db::dbvalue($value, $options);
}
//--------------------------------------------------------------------------------