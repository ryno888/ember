<?php

namespace app\ui;

/**
 * @package mod\ui\set\system
 * @author Ryno Van Zyl
 */
class ui extends \Kwerqy\Ember\com\ui\ui {
    //--------------------------------------------------------------------------------
    /**
     * @param array $options
     * @return false|string|null
     */
	public function product_card($data, $options = []) {

		$options = array_merge([
		    "data" => $data
		], $options);

		return \app\ui\set\bootstrap\product_card::make()->build($options);
	}
	//--------------------------------------------------------------------------------
}