<?php
namespace sessions;

class category_filter extends \Kwerqy\Ember\com\session\intf\session_helper {


    public float $price_from = 0;
    public float $price_to = 1000;
    public float $price_min = 0;
    public float $price_max = 0;

    public int $page = 1;
    public int $limit = 20;
    public int $total_items = 0;

    //--------------------------------------------------------------------------------
    protected function __construct($options = []) {

        parent::__construct($options);
    }
    //--------------------------------------------------------------------------------
    private function get_offset(){
        return $this->page == 1 ? 0 : $this->limit * ($this->page - 1);
    }
    //--------------------------------------------------------------------------------

    /**
     * @param array $options
     * @return \Kwerqy\Ember\com\db\sql\select|\Kwerqy\Ember\com\intf\standard
     */
    public function get_sql($options = []) {

        $options = array_merge([
            "include_price_search" => true
        ], $options);

        $sql = \Kwerqy\Ember\com\db\sql\select::make();
        $sql->select("product.*");
        $sql->from("product");

        $sql->and_where("pro_is_published = 1");

        if($options["include_price_search"]){
            if($this->price_from > 0) $sql->and_where("pro_price >= ".dbvalue($this->price_from));
            if($this->price_to > 0) $sql->and_where("pro_price <= ".dbvalue($this->price_to));
        }

        $sql->limit($this->limit);
        $sql->offset($this->get_offset());

        return $sql;
    }
    //--------------------------------------------------------------------------------
    public function get_min_max() {
        $sql = $this->get_sql(["include_price_search" => false]);
        $sql->clear_select();
        $sql->clear_limit();
        $sql->clear_offset();
        $sql->select("MIN(pro_price) AS min_price");
        $sql->select("MAX(pro_price) AS max_price");

        $data = \Kwerqy\Ember\Ember::db()->select($sql);
        if($data){
            $data = reset($data);

            $this->price_min = \Kwerqy\Ember\com\data\data::parse($data["min_price"], TYPE_FLOAT);
            $this->price_max = \Kwerqy\Ember\com\data\data::parse($data["max_price"], TYPE_FLOAT);
        }

        $sql = $this->get_sql();
        $sql->clear_select();
        $sql->select("COUNT(pro_id)");
        $sql->clear_limit();
        $sql->clear_offset();
        $this->total_items = \Kwerqy\Ember\Ember::db()->selectsingle($sql);
    }
    //--------------------------------------------------------------------------------
    protected function on_update($options = []) {
        $this->get_min_max();

        $total_pages = $this->get_total_pages();
        if($this->page > $total_pages) $this->page = $total_pages;
    }
    //--------------------------------------------------------------------------------
    public function get_total_pages() {
        return $this->total_items > 0 ? ceil($this->total_items / $this->limit) : 0;
    }
    //--------------------------------------------------------------------------------
}