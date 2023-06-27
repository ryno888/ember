<?php

class core {

    //--------------------------------------------------------------------------------

    /**
     * @param $table
     * @param array $options
     * @return mixed|\Kwerqy\Ember\com\db\intf\table|\Kwerqy\Ember\com\db\row
     */
	public static function dbt($table, $options = []) {
		return \Kwerqy\Ember\Ember::dbt($table, $options);
	}
    //--------------------------------------------------------------------------------
	public static function db() {
		return \Kwerqy\Ember\com\db\db::make();
	}
    //--------------------------------------------------------------------------------

}