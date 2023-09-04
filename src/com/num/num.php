<?php

namespace Kwerqy\Ember\com\num;

/**
 * @package mod\debug
 * @author Ryno Van Zyl
 */
class num {
	//--------------------------------------------------------------------------------
    public static function format_bytes($num, int $precision = 1, ?string $locale = null) {
        return number_to_size($num, $precision, $locale);
    }
	//--------------------------------------------------------------------------------
    public static function format_amount($num, int $precision = 1, ?string $locale = null) {
        return number_to_amount($num, $precision, $locale);
    }
	//--------------------------------------------------------------------------------
    public static function currency(float $num, $options = []) {

        $options = array_merge([
            "include_symbol" => true,
            "fraction" => \Kwerqy\Ember\Ember::$currency_fraction,
            "currency" => "ZAR",
            "locale" => "en_US",
        ], $options);

        $value = number_to_currency($num, $options["currency"], $options["locale"], $options["fraction"]);

        $replace_from = ["ZAR"];
        $replace_to = [\Kwerqy\Ember\Ember::$currency_symbol];

        if(!$options["include_symbol"]){
            $replace_to = "";
        }

        $value = str_replace($replace_from, $replace_to, $value);

        if(!$options["include_symbol"]){
            $value = html_entity_decode(str_replace("&nbsp;", "", htmlentities($value, null, 'utf-8')));
        }

        return $value;

    }
	//--------------------------------------------------------------------------------
}